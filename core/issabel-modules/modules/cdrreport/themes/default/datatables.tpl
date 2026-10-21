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
      <th>{$COLUMNS[8]}</th>
      <th>{$COLUMNS[9]}</th>
      <th>{$COLUMNS[15]}</th>
      <th>{$COLUMNS[14]}</th>
      <th>CEL</th>
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

<div class='modal' id='gridModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog {$modalClass}' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>{#modalTitle#}</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id='gridModalContent'>
        {$modalContent}
      </div>
    </div>
  </div>
</div>
