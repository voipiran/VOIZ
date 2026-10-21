'use strict';
/*
 * The utilities used to build our phone examples.

 * You may consider them an optional part of our SDK.
 * You can use them if they are suitable for your project or replace them with other libraries.
 * For example instead provided in this file AudioPlayer you may use other audio library,
 * instead storageLoadConfig other library to work with local storage, etc.
 *
 *  Load/save configuration from/to local storage
 *  - storageLoadConfig
 *  - storageSaveConfig
 *
 *  IndexedDB
 *  - AbstractDb (abstract indexeddb with single store)
 *  - CallLogDb (call log indexeddb)
 *  - VoiceDb   (recorded voice messages indexeddb)
 *  - MessageDb (received text messages indexeddb)
 *
 *  Audio, video
 *  - AudioPlayer2  
 *  - MRecorder
 *  - AnsweringMachine
 *
 *  SIP
 *  - AlertInfo parser
 *  - XVoiceQuality parser 
 *
 *  Conference
 *  - CallAudioMixer
 *  - CallVideoMixer
 *
 *  loadJavaScript (dinamically load arbitrary javascript)
 *  SelectDevices (enumerate and select microphone, camera, speaker)
 * 
 *  Igor Kolosov AudioCodes 2022
 *  Last edit 11-Aug-2022
 */

/**
 * Load JSON object from local storage
 *
 * If object does not exist, will be used default value.
 * If object exists, and has version different from default value version, will be used default value.
 *
 * The version used to override browser local storage value to default value from site.
 *
 * Example:
 *   We upgrade in our site phone from version 1.1 to 1.2.
 *   There are many users of phone version 1.1 in the world and they store some phone configuration
 *   to browser local storage.
 *   In phone version 1.2 the construction of the configuration object is different.
 *   To prevent errors, we should change version of default configuration object in our site,
 *   it forces to load updated version instead using saved in local storage.
 *   (See phone prototype config.js)
 *
 * For debugging can be used storeBack = true,
 * to edit stored value via browser dev. tools.
 */
function storageLoadConfig(name, defValue = null, useLog = true, storeBack = false) {
    let str_value = localStorage.getItem(name);
    let value = null;
    let isLoaded = false;
    let isReplaced = false;
    let isDefault;
    if (str_value) {
        isLoaded = true;
        value = JSON.parse(str_value);
    }
    if (value === null || (defValue !== null && value.version !== defValue.version)) {
        if (isLoaded)
            isReplaced = true;
        isLoaded = false;
        isDefault = true;
        if (defValue !== null)
            value = dataDeepCopy(defValue);
    } else {
        isDefault = dataEquals(value, defValue);
    }
    if (useLog) {
        console.log('Used %s %s', value !== null ? (isDefault ? 'default' : 'custom') : 'null', name);
    }
    if (value !== null && (isReplaced || (storeBack && !isLoaded)))
        localStorage.setItem(name, JSON.stringify(value));
    return value;
}

/**
 * Save JSON object to local storage.
 *
 * Default value is optional.
 * If it's provided and object has default value, it will be removed from local storage.
 */
function storageSaveConfig(name, value, defValue = null) {
    if (defValue === null || !dataEquals(value, defValue)) {
        if (defValue !== null && defValue.version && !value.version)
            value.version = defValue.version;
        localStorage.setItem(name, JSON.stringify(value));
    } else {
        localStorage.removeItem(name);
    }
}

// Objects deep equals
function dataEquals(obj1, obj2) {
    if (obj1 === null || obj2 === null) return obj1 === obj2;
    for (let p in obj1) {
        if (obj1.hasOwnProperty(p) !== obj2.hasOwnProperty(p)) return false;
        switch (typeof (obj1[p])) {
            case 'object':
                if (!dataEquals(obj1[p], obj2[p])) return false;
                break;
            case 'function': // No compare functions.
                break;
            default:
                if (obj1[p] != obj2[p]) return false;
        }
    }
    for (let p in obj2) {
        if (typeof (obj1[p]) == 'undefined') return false;
    }
    return true;
}

function dataDeepCopy(src) {
    if (src === null)
        return null;
    let dst = Array.isArray(src) ? [] : {};
    for (let p in src) {
        switch (typeof (src[p])) {
            case 'object':
                dst[p] = dataDeepCopy(src[p]);
                break;
            case 'function': // No copy
                break;
            default:
                dst[p] = src[p];
                break;
        }
    }
    return dst;
}


/**
 * Database with single store and with copy of the store in memory - objects list
 * Purpose: make the list persistent.
 * Key is part of record, based on current time, unique and has name 'id'
 * Number of objects in store is limited, oldest objects will be deleted.
 * If needed, additional stores can be added: override open(),
 * and use get(), put(), clear(), delete() methods with store name.
 */
class AbstractDb {
    constructor(dbName, storeName, maxSize) {
        this.dbName = dbName;
        this.storeName = storeName;
        this.maxSize = maxSize; // max number of objects
        this.db = null;
        this.list = []; // default store copy in memory.
        this.idSeqNumber = -1; // to generate unique key.
    }

    // Create store unique key. (no more than 1 million in the same millisecond)
    // key must be part or record and have name 'id'
    createId(time) {
        this.idSeqNumber = (this.idSeqNumber + 1) % 1000000; // range 0..999999
        return time.toString() + '-' + ('00000' + this.idSeqNumber.toString()).slice(-6);
    }

    // Open the database, if needed create it.
    open() {
        return new Promise((resolve, reject) => {
            let r = indexedDB.open(this.dbName);
            r.onupgradeneeded = (e) => {
                e.target.result.createObjectStore(this.storeName, { keyPath: 'id' });
            }
            r.onsuccess = () => {
                this.db = r.result;
                resolve();
            }
            r.onerror = r.onblocked = () => { reject(r.error); };
        });
    }

    // load records to memory, ordered by time, if needed delete oldest records
    load() {
        return new Promise((resolve, reject) => {
            if (this.db === null) { reject('db is null'); return; }
            let trn = this.db.transaction(this.storeName, 'readwrite');
            trn.onerror = () => { reject(trn.error); }
            let store = trn.objectStore(this.storeName)
            let onsuccess = (list) => {
                this.list = list;
                let nDel = this.list.length - this.maxSize;
                if (nDel <= 0) {
                    resolve();
                } else {
                    let r = store.delete(IDBKeyRange.upperBound(this.list[nDel - 1].id));
                    r.onerror = () => { reject(r.error); }
                    r.onsuccess = () => {
                        this.list = this.list.splice(-this.maxSize);
                        resolve();
                    }
                }
            }
            let onerror = (e) => { reject(e); }
            let getAll = store.getAll ? this._getAllBuiltIn : this._getAllCursor;
            getAll(store, onsuccess, onerror);
        });
    }

    _getAllBuiltIn(store, onsuccess, onerror) { // Chrome, Firefox
        let r = store.getAll();
        r.onerror = () => onerror(r.error);
        r.onsuccess = () => onsuccess(r.result);
    }

    _getAllCursor(store, onsuccess, onerror) { // Legacy Edge
        let list = [];
        let r = store.openCursor();
        r.onerror = () => onerror(r.error);
        r.onsuccess = (e) => {
            let cursor = e.target.result;
            if (cursor) {
                list.push(cursor.value);
                cursor.continue();
            } else {
                onsuccess(list);
            }
        };
    }

    // Add new record. If needed delete oldest records
    add(record) {
        return new Promise((resolve, reject) => {
            if (this.db === null) { reject('db is null'); return; }
            let trn = this.db.transaction(this.storeName, 'readwrite');
            trn.onerror = () => { reject(trn.error); }
            let store = trn.objectStore(this.storeName)
            let r = store.add(record);
            r.onerror = () => { reject(r.error); }
            r.onsuccess = () => {
                this.list.push(record);
                let nDel = this.list.length - this.maxSize;
                if (nDel <= 0) {
                    resolve();
                } else {
                    r = store.delete(IDBKeyRange.upperBound(this.list[nDel - 1].id));
                    r.onerror = () => { reject(r.error); }
                    r.onsuccess = () => {
                        this.list = this.list.splice(-this.maxSize);
                        resolve();
                    }
                }
            }
        });
    }

    // Update record with some unique id.
    update(record) {
        let index = this.list.findIndex((r) => r.id === record.id);
        if (index == -1)
            return Promise.reject('Record is not found');
        this.list[index] = record;
        return this._exec('put', this.storeName, record);
    }

    // Delete record with the key (if store is default delete also from list)
    delete(id, storeName = this.storeName) {
        if (storeName === this.storeName) {
            let index = this.list.findIndex((r) => r.id === id);
            if (index == -1)
                return Promise.reject('Record is not found');
            this.list.splice(index, 1);
        }
        return this._exec('delete', storeName, id);
    }

    // Clear all store records
    clear(storeName = this.storeName) {
        this.list = [];
        return this._exec('clear', storeName);
    }

    get(key, storeName) {
        return this._exec('get', storeName, key);
    }

    put(record, storeName) {
        return this._exec('put', storeName, record);
    }

    // Single transaction operation.
    _exec(op, storeName, data) {
        return new Promise((resolve, reject) => {
            if (this.db === null) { reject('db is null'); return; }
            let trn = this.db.transaction(storeName, 'readwrite');
            trn.onerror = () => { reject(trn.error); }
            let store = trn.objectStore(storeName)
            let r;
            switch (op) {
                case 'clear':
                    r = store.clear();
                    break;
                case 'delete':
                    r = store.delete(data);
                    break;
                case 'put':
                    r = store.put(data);
                    break;
                case 'get':
                    r = store.get(data);
                    break;
                default:
                    reject('db: wrong request');
                    return;
            }
            r.onerror = () => { reject(r.error); }
            r.onsuccess = () => { resolve(r.result); }
        });
    }
}


/**
 * To keep phone call logs.
 */
class CallLogDb extends AbstractDb {
    constructor(maxSize) {
        super('phone', 'call_log', maxSize);
    }
}

/*
 *  To use with automatic answer machine. Created 2 stores:
 *  'records' default store, to save last (up to maxSize) answer records.
 *  'greeting' additional store, to save custom greeting.
 */
class VoiceDb extends AbstractDb {
    constructor(maxSize) {
        super('voice_db', 'records', maxSize);
    }

    open() {
        return new Promise((resolve, reject) => {
            let r = indexedDB.open(this.dbName);
            r.onupgradeneeded = (e) => {
                e.target.result.createObjectStore(this.storeName, { keyPath: 'id' });
                e.target.result.createObjectStore('greeting', { keyPath: 'id' });
            }
            r.onsuccess = () => {
                this.db = r.result;
                resolve();
            }
            r.onerror = r.onblocked = () => { reject(r.error); };
        });
    }
}

/**
 * To keep incoming text messages.
 */
class MessageDb extends AbstractDb {
    constructor(maxSize) {
        super('message_db', 'messages', maxSize);
    }
}

/* 
 * AudioPlayer2
 *
 * There are audio web API: 
 *   - HTMLAudioElement  (Can be associated with speaker. Chrome only)
 *   - Audio Context.    (Uses default speaker)
 * 
 * For most operation systems and browsers HTMLAudioElement is best option.
 * The exception is macOS Safari and all iOS browsers (WebKit codebase)
 * WebKit HTMLAudioElement is about unusable for our case.
 * 
 * AudioPlayer2 can be configured to use HTMLAudioElement or AudioContext API to
 * play sound.
 * Both modes used AudioContext API to generate tones and sending audio stream.
 * 
 * Igor Kolosov AudioCodes Ltd 2022
 */
class AudioPlayer2 {
    constructor() {
        this.browser = this._browser();
        this.speakerDeviceId = undefined;  // undefined - don't use setSinkId, null or string uses setSinkId()
        this.ringerDeviceId = undefined;  // additional loudspeaker to play rings
        this.useAudioElement = undefined; // true/false switch HTMLAudioElement/AudioContext API
        this.logger = console.log;
        this.sounds = {};           // Sounds
        this.sound = null;          // Current sound
        this.ringer = null;         // Ringer sound
        this.ssound = null;         // Short sound
        this.audioCtx = null;
        this.dtmfTones = {
            '1': [{ f: [697, 1209], t: 0.2 }],
            '2': [{ f: [697, 1336], t: 0.2 }],
            '3': [{ f: [697, 1477], t: 0.2 }],
            '4': [{ f: [770, 1209], t: 0.2 }],
            '5': [{ f: [770, 1336], t: 0.2 }],
            '6': [{ f: [770, 1477], t: 0.2 }],
            '7': [{ f: [852, 1209], t: 0.2 }],
            '8': [{ f: [852, 1336], t: 0.2 }],
            '9': [{ f: [852, 1477], t: 0.2 }],
            '*': [{ f: [941, 1209], t: 0.2 }],
            '0': [{ f: [941, 1336], t: 0.2 }],
            '#': [{ f: [941, 1477], t: 0.2 }],
            'A': [{ f: [697, 1633], t: 0.2 }],
            'B': [{ f: [770, 1633], t: 0.2 }],
            'C': [{ f: [852, 1633], t: 0.2 }],
            'D': [{ f: [941, 1633], t: 0.2 }]
        };
    }

    /**
     * User can select API by setting:
     * useAudioElement: true
     * useAudioElement: false
     * useAudioElement: undefined (default) - API selected according using browser:
     *   used AudioElement API, except macOS Safari and any iOS browsers.
     */
    init(options = { logger: null, audioCtx: null, useAudioElement: undefined }) {
        this.logger = options.logger ? options.logger : console.log;
        this.audioCtx = options.audioCtx ? options.audioCtx : new (window.AudioContext || window.webkitAudioContext)();
        if (options.useAudioElement === true || options.useAudioElement === false)
            this.useAudioElement = options.useAudioElement; // user can select using API.
        else // or API will be selected automatically
            this.useAudioElement = !['safari', 'safari|ios'].includes(this.browser);

        this.logger(`AudioPlayer2: init ${this.useAudioElement ? 'AudioElement' : 'AudioContext'} (${this.browser})`);
    }

    // Set earpeace device for play().  For AudioElement mode in Chrome
    setSpeakerId(deviceId) {
        this.logger(`AudioPlayer2: setSpeakerId(${deviceId})`);
        this.speakerDeviceId = (deviceId !== null) ? deviceId : '';
    }

    // Set loudspeaker device for playRing(). For AudioElement mode in Chrome
    setRingerId(deviceId) {
        this.logger(`AudioPlayer2: setRingerId(${deviceId})`);
        this.ringerDeviceId = (deviceId) ? deviceId : null;
    }

    _browser() {
        if (/iPad|iPhone|iPod/.test(navigator.userAgent))
            return 'safari|ios'; // all iOS browsers (includes Safari, Chrome or Firefox)
        if (navigator.mozGetUserMedia)
            return 'firefox';
        if (navigator.webkitGetUserMedia)
            return 'chrome';
        if (window.safari)
            return 'safari';
        return 'other';
    }

    // To support auto-play policy.
    isDisabled() {
        if (this.audioCtx.state === 'interrupted')
            this.logger('AudioPlayer2: isDisabled() state = interrupted ! Hello from iOS');

        if (['chrome', 'safari', 'safari|ios'].includes(this.browser)) {
            return this.audioCtx.state === 'suspended';
        } else {
            return false;
        }
    }

    enable() {
        if (['chrome', 'safari', 'safari|ios'].includes(this.browser)) {
            return this.audioCtx.resume();
        } else {
            return Promise.resolve();
        }
    }

    /* 
     * Download MP3 sounds. Resolved when all sounds are loaded
     */
    downloadSounds(path, soundList) {
        this.logger(`AudioPlayer2: downloadSounds ${path} ${JSON.stringify(soundList)}`);
        if (!this.useAudioElement && ['safari', 'safari|ios'].includes(this.browser)) {
            this._setDecodeAudioDataShim(this.audioCtx);
        }
        let readyList = [];
        for (let sound of soundList) {
            let name, sname;
            if (typeof sound === 'string') {
                name = sname = sound;
            } else {
                name = Object.keys(sound)[0];
                sname = sound[name];
            }
            let file = path + sname + '.mp3';
            readyList.push(this.useAudioElement ? this._downloadSound1(name, file) : this._downloadSound2(name, file));
        }
        return Promise.allSettled(readyList);
    }

    generateTonesSuite(suite) {
        this.logger('AudioPlayer2: generateTonesSuite');
        let readyList = [];
        for (let toneName of Object.keys(suite)) {
            let toneDefinition = suite[toneName];
            readyList.push(this.useAudioElement ? this._generateTone1(toneName, toneDefinition) : this._generateTone2(toneName, toneDefinition));
        }
        return Promise.allSettled(readyList);
    }

    /**
     * Play sound in speaker
     * 
     * @param options
     *   name  sound clip name (must be set)
     *
     *   volume = 0 .. 1.0  Default 1.0   (for iOS HTMLAudioElement always 1.0)
     *   loop = true/false Endless loop
     *   repeat = number  Repeat <number> times
     *
     *   streamDestination (undefined by default), value mediaStreamDestination.
     *   Assign output to audio stream instead of speaker.
     *   
     * @returns Promise to check when playing is finished.
     */
    play(options, streamDestination = undefined) {
        if (this.isDisabled()) {
            this.logger(`AudioPlayer2: play: ${JSON.stringify(options)} [Sound is disabled]`);
            return Promise.resolve();
        }
        if (this.useAudioElement) {
            return streamDestination ? this._playStream1(options, streamDestination) : this._play1(options);
        } else {
            return this._play2(options, streamDestination);
        }
    }

    /**
     * Play ringing additionaly in loudspeaker (if configured)
     *
     * Note: the same sound name cannot be used in play() and playRing() -
     * because for each sound name created own HTMLAudioElement associated with
     * speaker.
     * So if for play() and playRing() used the same MP3 sound file,
     * use it with different sound names. (e.g. 'ring' and 'r_ring' in our examples)
     */
    playRing(options) {
        if (this.isDisabled()) {
            this.logger(`AudioPlayer2: playRing: ${JSON.stringify(options)} [Sound is disabled]`);
            return Promise.resolve();
        }
        return this.useAudioElement ? this._playRing1(options) : Promise.resolve();
    }

    /**
     * Stops playing. (if played)
     * Stops play() and playRing(), does not stop playShortSound()
     */
    stop() {
        this.useAudioElement ? this._stop1() : this._stop2();
    }

    /*
     * For independent of play(), playRing() and stop() usage.
     * Cannot be stopped.
     */
    playShortSound(options) {
        if (!this.audioCtx)
            return Promise.reject('No audio context');
        return this.useAudioElement ? this._playShortSound1(options) : this._playShortSound2(options);
    }

    /*
      HTMLAudioElement implementation
     */
    _downloadSound1(name, file) {
        let audioElem = new Audio(file);
        this.sounds[name] = {
            audioElem: audioElem,
            deviceId: '',            // associated device id
            source: null,            // linked MediaElementSource 
            streamDestination: null  // linked StreamDestination 
        };
        return new Promise((resolved, rejected) => {
            audioElem.oncanplaythrough = resolved;
            if (['safari', 'safari|ios'].includes(this.browser)) {
                audioElem.oncanplay = resolved;
                audioElem.onloadedmetadata = resolved;
            }
            audioElem.onerror = rejected;
        });
    }

    _generateTone1(toneName, toneDefinition) {
        return this._generateTone(toneDefinition)
            .then(data => {
                let audioElem = new Audio();
                let blob = this._createBlob1(data);
                audioElem.src = URL.createObjectURL(blob);
                this.sounds[toneName] = {
                    audioElem: audioElem,
                    deviceId: '',            // associated device id
                    source: null,
                    streamDestination: null
                };
            });
    }

    // Convert AudioBuffer to WAV Blob. 
    // Thanks to https://github.com/mattdiamond/Recorderjs  MIT lisence
    _createBlob1(audioBuffer) {
        function writeString(view, offset, string) {
            for (let i = 0; i < string.length; i++) {
                view.setUint8(offset + i, string.charCodeAt(i))
            }
        }
        function floatTo16BitPCM(output, offset, input, k) {
            for (let i = 0; i < input.length; i++, offset += 2) {
                let v = input[i] / k;
                let s = Math.max(-1, Math.min(1, v))
                output.setInt16(offset, s < 0 ? s * 0x8000 : s * 0x7FFF, true)
            }
        }
        function normalize(input) {
            let max = 0, min = 0;
            for (let i = 0; i < input.length; i++) {
                let v = input[i];
                max = Math.max(max, v)
                min = Math.min(min, v)
            }
            return (max - min) / 2;
        }
        let samples = audioBuffer.getChannelData(0);
        let sampleRate = audioBuffer.sampleRate;
        let format = 1;
        let bitDepth = 16;
        let bytesPerSample = bitDepth / 8;
        let numChannels = 1;
        let blockAlign = numChannels * bytesPerSample;

        let buffer = new ArrayBuffer(44 + samples.length * bytesPerSample);
        let view = new DataView(buffer);

        writeString(view, 0, 'RIFF');
        view.setUint32(4, 36 + samples.length * bytesPerSample, true);
        writeString(view, 8, 'WAVE');
        writeString(view, 12, 'fmt ');
        view.setUint32(16, 16, true);
        view.setUint16(20, format, true);
        view.setUint16(22, numChannels, true);
        view.setUint32(24, sampleRate, true);
        view.setUint32(28, sampleRate * blockAlign, true);
        view.setUint16(32, blockAlign, true);
        view.setUint16(34, bitDepth, true);
        writeString(view, 36, 'data');
        view.setUint32(40, samples.length * bytesPerSample, true);
        let k = normalize(samples);
        floatTo16BitPCM(view, 44, samples, k);
        return new Blob([buffer], { type: "audio/wav" });
    }

    _play1(options) {
        this.logger(`AudioPlayer2 [AudioElement]: play: ${JSON.stringify(options)}`);
        return this._play1_impl(options, 'sound', this.speakerDeviceId);
    }

    _playRing1(options) {
        if (!this.ringerDeviceId)
            return Promise.resolve();
        this.logger(`AudioPlayer2 [AudioElement]: playRing: ${JSON.stringify(options)}`);
        return this._play1_impl(options, 'ringer', this.ringerDeviceId);
    }

    _playShortSound1(options) {
        return this._play1_impl(options, 'ssound', this.speakerDeviceId);
    }

    _play1_impl(options, sname, deviceId) {
        this._silentStop1(this[sname]);

        let sound = this[sname] = this.sounds[options.name];
        if (!sound) {
            this.logger(`AudioPlayer2 [AudioElement]: missed sound: "${options.name}"`);
            return Promise.reject();
        }
        if (sound.source) {
            this.logger(`AudioPlayer2 [AudioElement]: sound "${options.name}" was used for streaming`);
            return Promise.reject();
        }

        return Promise.resolve()
            .then(() => {
                if (deviceId !== undefined && sound.audioElem.setSinkId !== undefined) {
                    if (sound.deviceId === deviceId) {
                        return Promise.resolve();
                    } else {
                        this.logger(`AudioPlayer2 [AudioElement]: "${options.name}": setSinkId deviceId="${deviceId}"`);
                        return sound.audioElem.setSinkId(deviceId);
                    }
                } else {
                    return Promise.resolve();
                }
            })
            .then(() => {
                sound.deviceId = deviceId;
            })
            .catch((e) => {
                // Sometimes there is Chrome error: 'The operation could not be performed and was aborted'
                this.logger(`AudioPlayer2 [AudioElement]: HTMLAudioElement.setSinkId error "${e.message}" [used default speaker]`);
            })
            .then(() => {
                sound.audioElem.volume = options.volume !== undefined ? options.volume : 1.0;
                sound.audioElem.loop = !!options.loop && options.repeat === undefined;
                let repeat = options.repeat !== undefined ? options.repeat : 1;

                return new Promise((resolve) => {
                    sound.audioElem.onended = () => {
                        if (--repeat > 0 && this[sname]) {
                            sound.audioElem.currentTime = 0;
                            sound.audioElem.play()
                                .catch((e) => {
                                    this.logger('AudioPlayer2 [AudioElement]: play error', e);
                                });
                        } else {
                            resolve();
                        }
                    }
                    sound.audioElem.currentTime = 0;
                    sound.audioElem.play()
                        .catch((e) => {
                            this.logger('AudioPlayer2 [AudioElement]: play error', e);
                        });
                });
            });
    }

    _playStream1(options, streamDestination) {
        this.logger(`AudioPlayer2 [AudioElement]: play stream: ${JSON.stringify(options)}`);
        this._silentStop1(this.sound);
        this.sound = this.sounds[options.name];
        if (!this.sound) {
            this.logger(`AudioPlayer2 [AudioElement]: missed media file: "${options.name}"`);
            return Promise.reject();
        }

        return new Promise((resolve) => {
            this.sound.audioElem.volume = options.volume !== undefined ? options.volume : 1.0;
            this.sound.audioElem.loop = !!options.loop && options.repeat === undefined;
            let repeat = options.repeat !== undefined ? options.repeat : 1;

            this.sound.audioElem.onended = () => {
                if (--repeat > 0 && this.sound) {
                    this.sound.audioElem.currentTime = 0;
                    this.sound.audioElem.play()
                        .catch((e) => {
                            this.logger('AudioPlayer2 [AudioElement]: streaming error', e);
                        });
                } else {
                    this.logger('AudioPlayer2 [AudioElement]: stopped');
                    resolve();
                }
            }
            this.sound.audioElem.currentTime = 0;
            // It's workaround of the issue: https://bugs.chromium.org/p/chromium/issues/detail?id=429204
            // (The Audio cannot be used in createMediaElementSource again)
            if (!this.sound.source) {
                this.sound.source = this.audioCtx.createMediaElementSource(this.sound.audioElem);
            }
            this.sound.streamDestination = streamDestination;
            this.sound.source.connect(this.sound.streamDestination);
            this.sound.audioElem.play()
                .catch((e) => {
                    this.logger('AudioPlayer2 [AudioElement]: streaming error', e);
                });
        });
    }

    _stop1() {
        this.logger('AudioPlayer2 [AudioElement]: stop');
        this._silentStop1(this.sound);
        this.sound = null;
        this._silentStop1(this.ringer);
        this.ringer = null;
    }

    _silentStop1(sound) {
        if (!sound)
            return;

        sound.audioElem.pause();

        if (sound.source) {
            try {
                sound.source && sound.source.disconnect();
                sound.streamDestination && sound.streamDestination.disconnect();
                sound.streamDestination = null;
            } catch (e) {
                this.logger('AudioPlayer2 [AudioElement]: disconnect AudioContext error', e);
            }
        }
    }

    /* 
      AudioContext implementation
    */
    _downloadSound2(name, file) {
        return fetch(file, { credentials: 'same-origin' })
            .then(response => {
                if (response.status >= 200 && response.status <= 299)
                    return response.arrayBuffer()
                        .catch(() => {
                            throw 'download body error';
                        });
                throw response.status === 404 ? 'file not found' : 'download error';
            })
            .then(data => {
                return this.audioCtx.decodeAudioData(data)
                    .catch(() => {
                        throw 'decoding error';
                    });
            })
            .then(decodedData => {
                this.sounds[name] = {
                    data: decodedData,
                    source: null,
                    gain: null,
                    streamDestination: null
                };
            })
            .catch(e => {
                this.logger('AudioPlayer2 [AudioContext]: ' + e + ': ' + file);
            });
    }

    _generateTone2(toneName, toneDefinition) {
        return this._generateTone(toneDefinition)
            .then(data => {
                if (data) {
                    this.sounds[toneName] = {
                        data: data,
                        source: null,
                        gain: null,
                        streamDestination: null,
                    };
                }
            })
    }

    _play2(options, streamDestination = null) {
        this.logger(`AudioPlayer2 [AudioContext]: ${streamDestination ? 'playStream' : 'play'}: ${JSON.stringify(options)}`);
        this._silentStop2(this.sound);
        let sound = this.sounds[options.name];
        if (!sound) {
            this.logger(`AudioPlayer2 [AudioContext]: missed media: "${options.name}"`);
            return Promise.reject();
        }
        this.sound = sound = Object.assign({}, sound);

        return new Promise((resolve, reject) => {
            try {
                sound.source = this.audioCtx.createBufferSource();
                sound.source.buffer = sound.data;

                sound.source.onended = () => {
                    this.logger(`AudioPlayer2 [AudioContext]:  onended ${options.name}`);
                    this._silentStop2(sound);
                    resolve(true);
                }
                sound.source.onerror = () => {
                    this.logger(`AudioPlayer2 [AudioContext]:  onerror ${options.name}`);
                    this._silentStop2(sound);
                    reject(new Error('onerror callback'));
                }

                sound.gain = this.audioCtx.createGain();
                let volume = options.volume ? options.volume : 1.0;
                sound.gain.gain.setValueAtTime(volume, this.audioCtx.currentTime);
                sound.source.connect(sound.gain);
                if (streamDestination) {
                    sound.streamDestination = streamDestination;
                    sound.gain.connect(sound.streamDestination);
                } else {
                    sound.streamDestination = null;
                    sound.gain.connect(this.audioCtx.destination);
                }

                if (options.loop === true || options.repeat) {
                    sound.source.loop = true;
                    sound.source.loopStart = 0;
                }

                let duration = null;
                if (options.repeat) {
                    duration = this.sound.source.buffer.duration * options.repeat;
                }

                sound.source.start(0, 0);
                if (duration)
                    sound.source.stop(this.audioCtx.currentTime + duration);
            } catch (e) {
                this.logger('AudioPlayer2 [AudioContext]: play error', e);
                this._silentStop2(sound);
                reject(e);
            }
        });
    }

    _playShortSound2(options) {
        let source;
        let gain;
        function release() {
            try {
                source && source.stop();
                gain && gain.disconnect();
                source && source.disconnect();
            } catch (e) {
                this.logger('AudioPlayer [AudioContext]: playShortSound: release error', e);
            }
        }
        return new Promise((resolve, reject) => {
            try {
                let sound = this.sounds[options.name];
                if (!sound) {
                    `AudioPlayer2 [AudioContext]: playShortSound: no sound: "${options.name}"`
                    reject('No sound');
                    return;
                }
                source = this.audioCtx.createBufferSource();
                source.buffer = sound.data;
                source.onended = () => {
                    release();
                    resolve();
                }
                source.onerror = (e) => {
                    release();
                    reject(e);
                }
                gain = this.audioCtx.createGain();
                let volume = options.volume ? options.volume : 1.0;
                gain.gain.setValueAtTime(volume, this.audioCtx.currentTime);
                source.connect(gain);
                gain.connect(this.audioCtx.destination);
                source.start();
            } catch (e) {
                this.logger('AudioPlayer [AudioContext]: playShortSound error', e);
                reject(e);
            }
        });
    }

    _stop2() {
        this.logger('AudioPlayer2 [AudioContext]: stop');
        this._silentStop2(this.sound);
        this.sound = null;
    }

    _silentStop2(sound) {
        if (!sound || !sound.source) {
            return;
        }
        try {
            sound.source && sound.source.stop();
        } catch (e) {
        }

        try {
            sound.gain && sound.gain.disconnect();
            sound.source && sound.source.disconnect();
            sound.streamDestination && sound.streamDestination.disconnect();
            sound.gain = null;
            sound.source = null;
            sound.streamDestination = null;
        } catch (e) {
            this.logger('AudioPlayer2 [AudioContext]: release resources error', e);
        }
    }

    /*
      Used in both implementations
    */
    // for Safari
    _setDecodeAudioDataShim(audioCtx) {
        let origDecodeAudioData = audioCtx.decodeAudioData;
        audioCtx.decodeAudioData = (data) => new Promise((resolve, reject) => {
            origDecodeAudioData.call(audioCtx, data, (d) => resolve(d), (e) => reject(e))
        });
    }

    // for Safari
    _setStartRenderingShim(offlineCtx) {
        let origStartRendering = offlineCtx.startRendering;
        offlineCtx.startRendering = () => new Promise((resolve) => {
            offlineCtx.oncomplete = (e) => { resolve(e.renderedBuffer); }
            origStartRendering.call(offlineCtx);
        });
    }

    _generateTone(toneDefinition) {
        function getArray(e) {
            if (e === undefined) return [];
            if (Array.isArray(e)) return e;
            return [e];
        }
        try {
            let duration = 0;
            let oscillatorNumber = 0;
            for (let step of toneDefinition) {
                duration += step.t;
                oscillatorNumber = Math.max(oscillatorNumber, getArray(step.f).length);
            }
            let channels = 1;
            let sampleRate = this.audioCtx.sampleRate;
            let frameCount = sampleRate * duration;
            let offlineCtx = new (window.OfflineAudioContext || window.webkitOfflineAudioContext)(channels, frameCount, sampleRate);
            if (this.browser === 'safari' || this.browser === 'safari|ios')
                this._setStartRenderingShim(offlineCtx);

            let oscillators = new Array(oscillatorNumber);
            for (let i = 0; i < oscillators.length; i++) {
                oscillators[i] = offlineCtx.createOscillator();
                oscillators[i].connect(offlineCtx.destination);
            }

            let time = 0;
            for (let i = 0, num = toneDefinition.length; i < num; i++) {
                let step = toneDefinition[i];
                let frequencies = getArray(step.f);
                for (let j = 0; j < oscillators.length; j++) {
                    let f = (j < frequencies.length) ? frequencies[j] : 0;
                    oscillators[j].frequency.setValueAtTime(f, offlineCtx.currentTime + time);
                }
                time += step.t;
            }

            for (let o of oscillators) {
                o.start(0);
                o.stop(offlineCtx.currentTime + duration);
            }

            return offlineCtx.startRendering()
                .then(renderedBuffer => {
                    for (let o of oscillators)
                        o.disconnect();
                    return renderedBuffer;
                });
        } catch (e) {
            this.logger('AudioPlayer2: cannot generate tone', e);
            return Promise.reject(e);
        }
    }
}

/*
 * Recording audio/video.
 * For modern browsers only. Used MediaRecorder API.
 * Can be used in Chrome, Edge, Firefox and Safari
 */
class MRecorder {
    constructor() {
        this.logger = null;
        this.audioCtx = null;
        this.chunks = [];
        this.recorder = null;
        this.browser = this._browser();
        this.defaultOptions = {
            'chrome': {
                audio: { mimeType: 'audio/webm;codec=opus' },
                /* 
                  Chrome 91 mediaRecorder

                  Not supported:
                    video: { mimeType: 'video/mp4;codecs=h264,opus' }
                    video: { mimeType: 'video/webm;codecs=av1x,opus' } // Could be supported in the future.

                  Supported:
                    video: { mimeType: 'video/webm;codecs=avc1,opus' } // CodecID: V_MPEG4/ISO/AVC  It's H264
                    video: { mimeType: 'video/webm;codecs=h264,opus' } // CodecID: V_MPEG4/ISO/AVC  It's H264
                    video: { mimeType: 'video/webm;codecs=vp8,opus' }  // CodecID: V_VP8
                    video: { mimeType: 'video/webm;codecs=vp9,opus' }  // CodecID: V_VP9
                */
                video: { mimeType: 'video/webm;codecs=vp8,opus' }
            },
            'firefox': {
                audio: { mimeType: 'audio/webm;codec=opus' },
                video: { mimeType: 'video/webm;codecs=vp8,opus' }
            },
            'safari': {
                audio: { mimeType: 'audio/mp4' },
                video: { mimeType: 'video/mp4' },
            },
            'ios_safari': {
                audio: { mimeType: 'audio/mp4' },
                video: { mimeType: 'video/mp4' },
            },
            'other': {
                audio: { mimeType: 'audio/webm' },
            }
        }[this.browser];
        this.selectedOptions = null;
    }

    _browser() {
        if (/iPad|iPhone|iPod/.test(navigator.userAgent))
            return 'ios_safari';
        if (navigator.mozGetUserMedia)
            return 'firefox';
        if (navigator.webkitGetUserMedia) // Work only for secure connection
            return 'chrome';
        if (window.safari)
            return 'safari';
        return 'other';
    }

    init(logger, audioCtx) {
        this.logger = logger;
        this.audioCtx = audioCtx;
    }

    isRecording() {
        return this.recorder && this.recorder.state === 'recording';
    }

    recordStream(stream, options) {
        this.logger(`MRecorder: recordStream()`);
        this.create(stream, options);
        return this.start()
            .then(blob => {
                this.closeStream();
                return blob;
            });
    }

    static canBeUsed() {
        return typeof MediaRecorder === 'function';
    }

    /**
     * To record only audio from audio/video stream use:
     * stream = new MediaStream(stream.getAudioTracks());
     *
     * To set non-default browser codecs use:
     * options = { mimeType: 'video/webm;codecs=vp9,opus' };
     */
    create(stream, options = null) {
        let isVideo = stream.getVideoTracks().length > 0;
        if (!options && isVideo && !this.defaultOptions.video) {
            isVideo = false;
            this.logger(`Warning: video mime undefined for ${this.browser}, records audio only`);
        }
        if (!options) {
            options = isVideo ? this.defaultOptions.video : this.defaultOptions.audio;
        }
        this.selectedOptions = options;
        this.logger(`MRecorder recorded ${isVideo ? '"video"' : '"audio"'}. Options: ${JSON.stringify(this.selectedOptions)}`);
        this.recorder = new MediaRecorder(stream, this.selectedOptions);
    }

    start() {
        return new Promise((resolve, reject) => {
            this.chunks = [];
            this.recorder.ondataavailable = (e) => {
                this.chunks.push(e.data);
            };
            this.recorder.onerror = (e) => {
                reject(e);
            }
            this.recorder.onstop = () => {
                this.logger(`MRecorder: create blob`);
                resolve(new Blob(this.chunks, { type: this.selectedOptions.mimeType }));
                this.chunks = [];
            };
            this.recorder.start();
        });
    }

    stop() {
        if (!this.recorder || this.recorder.state !== 'recording')
            return;
        this.logger('MRecorder: stop');
        this.recorder.stop();
    }

    closeStream() {
        for (let track of this.recorder.stream.getTracks())
            track.stop();
    }
}

/**
 * Automatic answering machine.
 * Play greeting, record answer.
 */
class AnsweringMachine {
    constructor() {
        this.use = true;
        this.startDelay = 16;
        this.recordDuration = 20;
        this.run = false;
        this.logger = null;
        this.call = null;
        this.streamDest = null;
        this.answerTimer = null;
        this.recordingTimer = null;
        this.audioPlayer = null;
        this.recorder = null;
        this.logger = null;
    }

    init(audioPlayer, recorder) {
        this.audioPlayer = audioPlayer;
        this.logger = audioPlayer.logger;
        this.recorder = recorder;
    }

    startTimer(call, answerCallback) {
        this.call = call;
        this.stopTimer();
        this.answerTimer = setTimeout(() => {
            this.run = true;
            answerCallback();
        }, this.startDelay * 1000);
    }

    stopTimer() {
        if (this.answerTimer !== null) {
            clearTimeout(this.answerTimer);
            this.answerTimer = null;
        }
    }

    setStreamDestination(streamDest) {
        this.streamDest = streamDest;
    }

    // Called if a call is terminated.
    stop(call) {
        if (call === this.call) {
            this.stopTimer();
            this.recorder.stop();
            if (this.recordingTimer !== null) {
                clearTimeout(this.recordingTimer);
                this.recordingTimer = null;
            }
            this.run = false;
        }
    }

    // Use destination stream, instead speaker.
    playGreeting() {
        return this.audioPlayer.play({
            name: 'greeting',
            volume: 1.0,
            startDelay: 1.6
        }, this.streamDest)
            .then(() => {
                return this.audioPlayer.play({
                    name: 'beep',
                    volume: 0.2,
                }, this.streamDest);
            })
    }

    // Record remote stream of the call.
    recordAnswer(remoteStream) {
        this.recorder.create(remoteStream);

        this.recordingTimer = setTimeout(() => {
            this.logger('AnsweringMachine: maximum recording time reached.');
            this.recorder.stop();
        }, this.recordDuration * 1000);

        return this.recorder.start()
            .then(blob => {
                this.run = false;
                return blob;
            });
    }
}

/**
 *  SIP Alert-Info header parser.
 *
 * Alert-Info   =  "Alert-Info" HCOLON alert-param *(COMMA alert-param)
 * alert-param  =  LAQUOT absoluteURI RAQUOT *( SEMI generic-param )
 */
class AlertInfo {
    constructor(incomingMsg) {
        this.parsed = [];
        try {
            for (let hh of incomingMsg.getHeaders('alert-info')) {
                for (let h of hh.split(',')) {
                    this._parseHeader(h);
                }
            }
        } catch (e) {
            console.log('Alert-Info parsing error', e);
        }
    }

    _parseHeader(h) {
        let st = h.split(';');
        let url;
        let pr_st = 0;
        if (st[0].startsWith('<') && st[0].endsWith('>')) {
            url = st[0].slice(1, -1);
            pr_st = 1;
        }
        let params = new Map();
        for (let pr of st.slice(pr_st)) {
            let eq = pr.indexOf('=');
            if (eq !== -1) {
                let k = pr.substring(0, eq);
                let v = pr.substring(eq + 1);
                if (v.startsWith('"') && v.endsWith('"'))
                    v = v.slice(1, -1);
                params.set(k.toLowerCase(), v.toLowerCase());
            }
        }
        this.parsed.push({ url: url, params: params });
    }

    exists() {
        return this.parsed.length > 0;
    }

    param(key, ix = 0) {
        if (ix >= this.parsed.length)
            return null;
        return this.parsed[ix].params.get(key)
    }

    url(ix = 0) {
        return this.parsed[ix].url;
    }

    getDelay(ix = 0) {
        let delay = this.param('delay', ix);
        if (!delay)
            return -1;
        return parseInt(delay);
    }

    hasAutoAnswer(ix = 0) {
        return this.param('info', ix) === 'alert-autoanswer';
    }
}

/* 
 * AudioCodes X-VoiceQuality header parser
 */
function getXVoiceQuality(request) {
    let header = request.getHeader('X-VoiceQuality');
    if (!header) {
        return undefined;
    }
    let words = header.trim().split(' ');
    if (words.length !== 2) {  // should be 2 tokens.
        console.log('X-VoiceQuality header: parsing problem: must be 2 tokens');
        return undefined;
    }
    let score = parseInt(words[0]);
    if (isNaN(score)) {
        console.log('X-VoiceQuality header: parsing problem: the first token is not number');
        return undefined;
    }
    let color = words[1].trim().toLowerCase();
    return { score, color };
}

/**
 *  Audio mixer (for audio conference)
 */
class CallAudioMixer {
    // For each call created audio mixer instance.
    // Аudio context can be taken from audio player
    constructor(audioCtx, call) {
        this.audioCtx = audioCtx;
        this.dest = this.audioCtx.createMediaStreamDestination();
        this.calls = [];
        let source = this.audioCtx.createMediaStreamSource(call.getRTCLocalStream());
        source.connect(this.dest);
        this.calls.push({ call, source });
    }

    // Close mixer, release all resources.
    close() {
        if (this.dest !== null) {
            this.dest.disconnect();
            this.dest = null;
        }
        for (let c of this.calls) {
            c.source.disconnect();
        }
        this.calls = [];
    }

    // Get mixed audio stream
    getMix() { return this.dest.stream; }

    // Add call to mixer.
    // Returns true if added, false if the call is already added.
    add(call) {
        let ix = this.calls.findIndex(c => c.call === call);
        if (ix !== -1)
            return false;
        let stream = call.getRTCRemoteStream();
        let source = this.audioCtx.createMediaStreamSource(stream);
        source.connect(this.dest);
        this.calls.push({ call, source });
        return true;
    }

    // Remove call from mixer
    // Returns true if removed.
    // Returns false, if the call was not added, or cannot be removed, because set in constructor.
    remove(call) {
        let ix = this.calls.findIndex(c => c.call === call);
        if (ix === -1 || ix === 0)
            return false;
        this.calls[ix].source.disconnect();
        this.calls.splice(ix, 1);
        return true;
    }

    // Returns string with calls list
    toString() { return 'audio mixer ' + this.calls.map((c) => c.call.data['_line_index'] + 1); }
}

/**
 *  Video mixer (for video conference)
 */
class CallVideoMixer {
    // Used single instance for all calls.
    constructor() {
        this.layout = 'compact';
        this.run = false;
        this.calls = [];
        this.localVideo = null;
        this.canvas = null;
        this.canvasCtx = null;
        this.canvasBackground = "#F5F5F5"; // light smoke
        this.width = 160;
        this.height = 120;
        this.nVideo = 0;
        this.drawInterval = 100;
        this.remoteVideoId = '';
        this.frame = 1;
        this.data = {};
    }

    // Set canvas id.
    // Set local video element id.
    // Set remote video element id prefix. (will be added video element index 0, 1, ...)
    setElements(canvasId, localVideoId, remoteVideoId) {
        this.canvas = document.getElementById(canvasId);
        this.canvasCtx = this.canvas.getContext('2d');
        this.localVideo = document.getElementById(localVideoId);
        this.remoteVideoId = remoteVideoId;
    }

    // Set number of frames per seconds of mixed stream.
    // For example: 1, 2, 5, 10, 20, 50.
    // Default: 10
    setFPS(v) { this.setDrawInterval(1000 / v); }

    // Set interval between draw (milliseconds)
    // Default: 100
    // It can be set also via setFPS
    setDrawInterval(v) { this.drawInterval = v; }

    // Set calls video layout: 'linear' or 'compact'
    // Default: 'compact'
    setLayout(v) {
        switch (v) {
            case 'linear':
            case 'compact':
                this.layout = v;
                break;
            default:
                throw new TypeError(`Unknown layout: ${v}`);
        }
        this.resize();
    }

    // Set call video size (pixels)
    // Default w=160, h=120
    setSize(w, h) {
        this.width = w;
        this.height = h;
        this.resize();
    }

    // Set call video sizes (pixels)
    // size likes: {width: '160px', height: '120px'}
    setSizes(size) { // format {width: '160px', height: '120px'}
        let w = parseInt(size.width.slice(0, -2));
        let h = parseInt(size.height.slice(0, -2));
        this.setSize(w, h);
    }

    // Returns true when mixer is started
    isOn() { return this.run; }

    // Start mixer
    start() {
        if (this.run)
            return;
        setTimeout(this._draw.bind(this), this.drawInterval);
        this.run = true;
    }

    // Stop mixer, remove all calls, release resources.
    // After using stop the mixer can be restarted.
    stop() {
        while (this.calls.length > 0)
            this.remove(this.calls[0].call);
        this.run = false;
    }

    // Get mixed video stream for added call.
    getMix(call) {
        let ix = this.calls.findIndex(d => d.call === call);
        return (ix !== -1) ? this.calls[ix].mix : null;
    }

    // Add call to mixer or update send/receive mode.
    // Returns true if send video was added (should be replaced connection sender track)
    add(call, send = true, receive = true) {
        let ix = this.calls.findIndex(d => d.call === call);
        if (ix === -1) {
            return this._add(call, send, receive);
        } else {
            return this._update(ix, send, receive);
        }
    }

    _add(call, send, receive) {
        let mix = send ? this.canvas.captureStream() : null;
        let elt = receive ? document.getElementById(this.remoteVideoId + call.data['_line_index']) : null;
        let x = 0;
        let y = 0;
        this.calls.push({ call, elt, mix, x, y });
        if (elt !== null)
            this.resize();
        return mix !== null;
    }

    _update(ix, send, receive) {
        let d = this.calls[ix];
        let sendModified = false;
        if (send) {
            if (d.mix === null) {
                d.mix = this.canvas.captureStream();
                sendModified = true;
            }
        } else {
            if (d.mix !== null) {
                for (let track of d.mix.getVideoTracks())
                    track.stop();
                d.mix = null;
                sendModified = true;
            }
        }
        if (receive) {
            if (d.elt === null) {
                d.elt = document.getElementById(this.remoteVideoId + d.call.data['_line_index']);
                this.resize();
            }
        } else {
            if (d.elt !== null) {
                d.elt = null;
                this.resize();
            }
        }
        return sendModified;
    }

    // Remove call from mixer.
    // Returns true if removed, false if was not added.
    remove(call) {
        let ix = this.calls.findIndex(d => d.call === call);
        //console.log('video mixer: remove call with index=', call.data['_line_index'], ix);
        if (ix === -1)
            return false;
        let d = this.calls[ix];
        if (d.mix !== null) {
            for (let track of d.mix.getVideoTracks())
                track.stop();
        }
        this.calls.splice(ix, 1);
        if (d.elt !== null)
            this.resize();
        return true;
    }

    // number of video displayed in canvas
    _nVideo() {
        let n = 0;
        if (this.localVideo.srcObject !== null)
            n++;
        for (let d of this.calls)
            if (d.elt !== null)
                n++;
        return n;
    }

    // Resize video layout then changed number of video channels
    // Used when added/removed local video channel.
    // Called automatically in methods: add, remove, setLayout, setSize
    //
    // Warning: it's designed for 5 lines phone !
    // Max number of video controls is 6 (including local video)
    // If you use more lines, please modify this method.
    //
    // Video layouts
    // linear   0 1     0 1 2     0 1 2 3    0 1 2 3 4 ....
    //
    // compact  0 1     0 1      0 1      0 1 2     0 1 2
    //                   2       2 3       3 4      3 4 5
    resize() {
        this.nVideo = this._nVideo(); // number of shown video
        //console.log(`videoMixer: resize nVideo=${this.nVideo} [${this.localVideo.srcObject !== null ? 'with local':'without local'} video]`);
        switch (this.layout) {
            case 'linear':
                this.canvas.width = (this.width + this.frame) * this.nVideo;
                this.canvas.height = this.height;
                break;
            case 'compact':
                if (this.nVideo <= 2) {
                    this.canvas.width = (this.width + this.frame) * this.nVideo;
                    this.canvas.height = this.height;
                } else if (this.nVideo <= 4) {
                    this.canvas.width = (this.width + this.frame) * 2;
                    this.canvas.height = this.height * 2 + this.frame;
                } else {
                    this.canvas.width = this.width * 3;
                    this.canvas.height = this.height * 2 + this.frame;
                }
                break;
        }

        this.canvasCtx.fillStyle = this.canvasBackground;
        this.canvasCtx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        // sort calls by line index
        this.calls.sort((d1, d2) => d1.call.data['_line_index'] - d2.call.data['_line_index']);

        // reorder pictures in canvas
        let ix = 0;
        if (this.localVideo.srcObject !== null)
            ix++;
        for (let d of this.calls) {
            if (d.elt !== null) {
                let [x, y] = this._location(ix);
                d.x = x;
                d.y = y;
                ix++;
            }
        }
    }

    // Calculate video picture location by index.
    //
    // Warning: it's designed for 5 lines phone !
    // Max number of video controls is 6 (including local video)
    // If you use more lines, modify this method
    _location(ix) {
        let w = this.width + this.frame;
        let h = this.height + this.frame;
        switch (this.layout) {
            case 'linear':
                return [ix * w, 0];
            case 'compact':
                switch (this.nVideo) {
                    case 0:
                    case 1:
                    case 2:
                        return [ix * w, 0];
                    case 3:
                        return (ix < 2) ? [w, 0] : [w * (ix - 2) + 0.5 * w, h];
                    case 4:
                        return (ix < 2) ? [w, 0] : [w * (ix - 2), h];
                    case 5:
                        return (ix < 3) ? [w * ix, 0] : [w * (ix - 3) + 0.5 * w, h];
                    case 6:
                        return (ix < 3) ? [w * ix, 0] : [w * (ix - 3), h];
                }
        }
    }

    _draw() {
        if (!this.run)
            return;
        try {
            if (this.nVideo > 0) {
                if (this.localVideo.srcObject !== null)
                    this.canvasCtx.drawImage(this.localVideo, 0, 0, this.width, this.height);
                for (let d of this.calls) {
                    if (d.elt !== null)
                        this.canvasCtx.drawImage(d.elt, d.x, d.y, this.width, this.height);
                }
            }
        } catch (e) {
            console.log(e);
        }
        setTimeout(this._draw.bind(this), this.drawInterval);
    }

    // Returns string with calls list
    toString() {
        if (this.run) {
            return 'video mixer ' + this.calls.map((c) => `${c.call.data['_line_index'] + 1}${c.mix !== null ? 's' : ''}${c.elt !== null ? 'r' : ''}`);
        } else {
            return 'video mixer is off';
        }
    }
}

// Dynamically load arbitrary javascript
function loadJavaScript(url) {
    return new Promise((resolve, reject) => {
        let script = document.createElement('script');
        script.onload = resolve;
        script.onerror = reject;
        script.src = url;
        document.head.appendChild(script);
    });
}

/**
 * Enumerate available devices: microphones, cameras, speakers (only Chrome provides speakers).
 * Allow select devices, save the selection to local storage.
 * Restore the device selection in the next sessions.
 *
 * Selected microphone and camera used in getUserMedia method as deviceId constraint.
 * Selected speaker and ringer associated with HTMLAudioElement by setSinkId method (only in Chrome).
 */
class SelectDevices {
    // Parameters can be modified before enumerate() method.
    constructor() {
        this.defaultPseudoDevice = true;
        this.names = [];
        this.enumerateDevices = AudioCodesUA.instance.getWR().mediaDevices.enumerateDevices;     // enumerate devices function.
        this.browserDefaultLabel = '-- browser default--'; // default pseudo device - means do not use deviceId and sinkId
        this.emptyLabel = '-- no label --';                 // for label = '' in incomplete device list
        this.previousSelection = null;                // device selection from local storage
    }

    setDevices(defaultPseudoDevice, devices) {
        this.defaultPseudoDevice = defaultPseudoDevice;
        this.names = [];
        for (let device of devices) {
            if (!['audioinput', 'audiooutput', 'videoinput'].includes(device.kind))
                throw new TypeException(`Illegal kind: ${device.kind}`)
            this.names.push(device.name);
            this[device.name] = { kind: device.kind };
        }
    }

    setEnumerateDevices(method) {
        this.enumerateDevices = method;
    }

    enumerate(useGetUserMediaIfNeed) {
        let stream = null;
        let incomplete = false;
        return Promise.resolve()
            .then(() =>
                this.doEnumerate())
            .then((inc) => {
                incomplete = inc;
                if (incomplete && useGetUserMediaIfNeed) {
                    return AudioCodesUA.instance.getWR().getUserMedia({ audio: true, video: true });
                } else {
                    return Promise.resolve(null);
                }
            })
            .then((s) => {
                stream = s;
                if (stream) {
                    // For incomplete device list repeat with open stream.
                    return this.doEnumerate();
                }
            })
            .then(() => {
                if (stream) {
                    incomplete = false;
                    stream.getTracks().forEach(track => track.stop());
                }
            })
            .then(() => {
                // Restore previous selection.
                if (this.previousSelection) {
                    for (let name of this.names) {
                        if (!this.findPreviousSelection(name)) {
                            if (incomplete)
                                this.addPreviousSelection(name);
                        }
                    }
                }
            });
    }

    // Without open stream by getUserMedia (or without permission to use microphone/camera)
    // device list will be incomplete:
    // some devices will be with empty string label, some devices can be missed.
    doEnumerate() {
        let incomplete = false; // exists incomplete device lists
        let emptyLabel = this.emptyLabel;

        function setLabel(device, str) {
            if (str)
                return str;
            incomplete = device.incomplete = true;
            return emptyLabel;
        }

        // reset device list and selection index.
        for (let name of this.names) {
            let device = this.getDevice(name);
            device.incomplete = false;
            if (this.defaultPseudoDevice) {
                device.index = 0; // selected browser default pseudo-device.
                device.list = [{ deviceId: null, label: this.browserDefaultLabel }];
            } else {
                device.index = -1; // device is not selected.
                device.list = [];
            }
        }

        return this.enumerateDevices()
            .then((infos) => {
                for (let info of infos) {
                    for (let name of this.names) {
                        let device = this.getDevice(name);
                        if (info.kind === device.kind) {
                            device.list.push({ deviceId: info.deviceId, label: setLabel(device, info.label) })
                        }
                    }
                }
            })
            .then(() => {
                return incomplete;
            });
    }

    // Select device using previously saved device label
    findPreviousSelection(name) {
        let device = this.getDevice(name);
        let sel = this.previousSelection && this.previousSelection[name];
        if (!sel || sel.label === this.emptyLabel)
            return false;
        for (let ix = 0; ix < device.list.length; ix++) {
            if (device.list[ix].label === sel.label) {
                device.index = ix;
                return true;
            }
        }
        return false;
    }

    // Without open stream by getUserMedia enumerate devices provides incomplete device list.
    // In the case we add previously selected device to the incomplete list.
    // Problem: previously used USB or bluetooth headset/camera could be disconnected.
    addPreviousSelection(name) {
        let device = this.getDevice(name);
        let sel = this.previousSelection && this.previousSelection[name];
        if (sel && sel.label !== this.browserDefaultLabel && sel.label !== this.emptyLabel) {
            AudioCodesUA.ac_log(`devices: added previously selected ${name} "${sel.label}"`);
            device.list.push(sel);
            device.index = device.list.length - 1;
        }
    }

    // Returns selected device object { deviceId: '', label: ''}
    getDevice(name) {
        if (!this[name])
            throw new TypeError(`wrong device name: ${name}`);
        return this[name];
    }

    getSelected(name) {
        let device = this.getDevice(name);
        if (device.list.length === 0 || device.index === -1) // device list is empty or device is not selected 
            return { deviceId: null, label: this.emptyLabel };
        return device.list[device.index];
    }

    getNumber(name) {
        return this.getDevice(name).list.length;
    }

    // Set selected by GUI device
    setSelectedIndex(name, index) {
        let device = this.getDevice(name);
        if (index < 0 || index >= device.list.length)
            throw new RangeError(`setSelectedIndex ${name} index=${index}`);
        device.index = index;
    }

    // Store selected devices. Supposed local storage usage.
    store() {
        this.previousSelection = null;
        for (let name of this.names) {
            let device = this.getDevice(name);
            if (device.list.length === 0 || device.index === -1)
                continue;
            if (!this.previousSelection)
                this.previousSelection = {};
            this.previousSelection[name] = this.getSelected(name);
        }
        return this.previousSelection;
    }

    // Load previously stored selected devices. Can be null if no stored devices.
    load(obj) {
        this.previousSelection = obj;
    }

    // Device connected/removed event
    addDeviceChangeListener(listener) {
        AudioCodesUA.instance.getWR().mediaDevices.addDeviceChangeListener(listener);
    }

    removeDeviceChangeListener(listener) {
        AudioCodesUA.instance.getWR().mediaDevices.removeDeviceChangeListener(listener);
    }
}
