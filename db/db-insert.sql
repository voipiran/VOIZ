USE asterisk;

INSERT INTO trunks (trunkid, name, tech, keepcid, failscript, dialoutprefix, channelid, disabled)
VALUES ('2', 'TCI', 'sip', 'off', '', '', 'TCI', 'off');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-2', 'account', 'TCI', '2');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-2', 'host', '**tci-sbc-ipaddress**', '3');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-2', 'qualify', 'yes', '4');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-2', 'type', 'peer', '5');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-2', 'context', 'from-trunk', '6');


INSERT INTO trunks (trunkid, name, tech, outcid, keepcid, failscript, dialoutprefix, channelid, usercontext, disabled)
VALUES ('3', 'SHATEL', 'sip', '**shatel-number**','off', '', '', 'SHATEL', '**shatel-username**','off');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'account', 'SHATEL', '2');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'host', '185.73.1.2', '3');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'username', '**shatel-username**', '4');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'secret', '**shatel-password**', '5');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'type', 'friend', '6');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'qualify', 'yes', '7');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'nat', 'yes', '8');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-3', 'insecure', 'very', '9');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-user-3', 'account', '**shatel-username**', '2');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-user-3', 'secret', '**shatel-password**', '3');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-user-3', 'type', 'user', '4');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-user-3', 'context', 'from-trunk', '5');

INSERT INTO trunks (trunkid, name, tech, keepcid, failscript, dialoutprefix, channelid, disabled)
VALUES ('4', 'GRANDSTREAM', 'sip', 'off', '', '', 'GRANDSTREAM', 'off');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'account', 'GRANDSTREAM', '2');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'host', '**grandstream-ipaddress**', '3');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'qualify', 'yes', '4');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'type', 'peer', '5');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'context', 'from-trunk', '6');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'insecure', 'very', '7');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-4', 'dtmfmode', 'rfc2833', '8');

INSERT INTO trunks (trunkid, name, tech, keepcid, failscript, dialoutprefix, channelid, disabled)
VALUES ('5', 'DLINK', 'sip', 'off', '', '', 'DLINK', 'off');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'account', 'DLINK', '2');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'host', '**dlink-ipaddress**', '3');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'qualify', 'yes', '4');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'type', 'peer', '5');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'context', 'from-trunk', '6');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'insecure', 'very', '7');
INSERT INTO sip (id, keyword, data, flags)
VALUES ('tr-peer-5', 'dtmfmode', 'rfc2833', '8');

