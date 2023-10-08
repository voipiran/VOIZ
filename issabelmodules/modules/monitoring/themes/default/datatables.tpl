<style>
.nopadding {
   padding: 0 !important;
   margin: 0 !important;
}
.table-striped > tbody > tr.selected > td,
.table-striped > tbody > tr.selected > th {
background-color: #522b76;
background-image: linear-gradient(#cccccc, #b3b3b3, #8c8c8c, #737373);
}
</style>

<script>
var cdrs = {$CDR};
var lang = "{$LANG}";
var DELMSG = "{$DELMSG}";
var module = "{$module_name}";
var puedeBorrar = "{$puedeBorrar}";
</script>

<script>
{$customJS}
</script>

<style>
        #loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #522b76;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .center {
            position: relative;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

.table th, .table td {
        font-size: 90%;
    }

mark {
      background: purple;
      color: white;
}
#myChart{
               background-color:white; 
               }

</style>


</br>
<span id="msgFilter">
    {$FILTER_MSG}
</span>
</br>
</br>
<table id='CDRreport' class="table table-striped table-bordered table-hover" style="width:100%">
  <thead>
    <tr>
      <th>{$COLUMNS[0]}</th>
      <th>{$COLUMNS[1]}</th>
      <th>{$COLUMNS[2]}</th>
      <th>{$COLUMNS[3]}</th>
      <th>{$COLUMNS[4]}</th>
      <th>{$COLUMNS[5]}</th>
      <th>{$COLUMNS[6]}</th>
      <th>{$COLUMNS[7]}</th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
<div id="loader" class="center"></div>

<div class="chart-container" id=chart>
  <canvas id="myChart" height=220></canvas>
</div>

<div class="text-right">
  <button type="button" class="btn btn-link" id="download-pdf2" onclick="downloadPDF2()">
    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
    PDF
  </button>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
      <div id="single-song-player">
      <span class="close">&times;</span>
      <div class="bottom-container">
        <!-- <progress class="amplitude-song-played-progress" id="song-played-progress"></progress> -->
        <input type="range" class="amplitude-song-slider" data-amplitude-song-index="0"/>

        <div class="time-container">
          <span class="current-time">
            <span class="amplitude-current-minutes"></span>:<span class="amplitude-current-seconds"></span>
          </span>
          <span class="duration">
            <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
          </span>
        </div>

        <div class="control-container">
          <div class="amplitude-play-pause" id="play-pause"></div>
          <div class="meta-container">
            <span data-amplitude-song-info="name" class="song-name"></span>
            <span data-amplitude-song-info="artist"></span>
          </div>
        </div>
      </div>
    </div>
</div>
