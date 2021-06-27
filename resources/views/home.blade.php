@extends('layouts.app')

@section('content')
    <div class="content-wrapper pb-0">
           <div class="card">
                  <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="card-title"> Orders </div>
                          <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-50">
                              <canvas id="doughnutChart1" width="100" height="100"></canvas>
                            </div>
                            <div id="doughnut-chart-legend" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="card-title"> Leads </div>
                          <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-50">
                              <canvas id="doughnutChart2" width="100" height="100"></canvas>
                            </div>
                            <div id="doughnut-chart-legend2" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                </div>



          </div>
          <!-- content-wrapper ends -->
@endsection
@section('js')
@parent
{{-- <script src="{{ asset('assets') }}/js/dashboard.js"></script> --}}
<script src="{{ asset('assets') }}/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
<script src="{{ asset('assets') }}/vendors/chart.js/Chart.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    // doughnut chart starts here
    if ($("#doughnutChart1").length) {
      var ctx = document.getElementById('doughnutChart1').getContext("2d");

      var Blue = '#00d284';

      var red = '#ff5730';

      var black = '#000000';

      var yellow = '#ff0854';

      var SkyBlue = '#05c9f5';

      var trafficChartData = {
        datasets: [{
          data: [{{ App\Models\Order::where('status_id',4)->count() }}, {{ App\Models\Order::where('status_id',8)->count() }}, {{ App\Models\Order::where('status_id',6)->count() }}, {{ App\Models\Order::where('status_id',7)->count() }}, {{ App\Models\Order::where('status_id', 5)->count() }}],
          backgroundColor: [
            red,
            Blue,
            black,
            yellow,
            SkyBlue
          ],
          hoverBackgroundColor: [
            red,
            Blue,
            black,
            yellow,
            SkyBlue
          ],
          borderColor: [
            red,
            Blue,
            black,
            yellow,
            SkyBlue
          ],
          legendColor: [
            red,
            Blue,
            black,
            yellow,
            SkyBlue
          ]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Being Processed',
          'Completed',
          'Cancelled',
          'Refund',
          'Shipped, Invoice Pending',
        ]
      };
      var trafficChartOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<ul>');
          for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
            text.push('<li><span class="legend-dots" style="background:' +
              trafficChartData.datasets[0].legendColor[i] +
              '"></span>');
            if (trafficChartData.labels[i]) {
              text.push(trafficChartData.labels[i]);
            }
            // text.push('<span class="float-right">' + trafficChartData.datasets[0].data[i] + "%" + '</span>')
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join('');
        }
      };
      var trafficChartCanvas = $("#doughnutChart1").get(0).getContext("2d");
      var trafficChart = new Chart(trafficChartCanvas, {
        type: 'doughnut',
        data: trafficChartData,
        options: trafficChartOptions
      });
      $("#doughnut-chart-legend").html(trafficChart.generateLegend());
    }

    if ($("#doughnutChart2").length) {
      var ctx = document.getElementById('doughnutChart2').getContext("2d");

      var blue = '#00cff4';

       var red = '#ff5730';

      var green = '#00d284';

      var trafficChartData = {
        datasets: [{
         data: [ {{ App\Models\Lead::where('status_id', 1)->count() }}, {{ App\Models\Lead::where('status_id',2)->count() }}, {{ App\Models\Lead::where('status_id',3)->count() }} ],
          backgroundColor: [
            red,
            green,
            Blue
          ],
          hoverBackgroundColor: [
            red,
            green,
            Blue
          ],
          borderColor: [
            red,
            green,
            Blue
          ],
          legendColor: [
            red,
            green,
            Blue
          ]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Pending Customer Consent',
          'Sale Order Created',
          'Customer Not Interested',
        ]
      };
      var trafficChartOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<ul>');
          for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
            text.push('<li><span class="legend-dots" style="background:' +
              trafficChartData.datasets[0].legendColor[i] +
              '"></span>');
            if (trafficChartData.labels[i]) {
              text.push(trafficChartData.labels[i]);
            }
            // text.push('<span class="float-right">' + trafficChartData.datasets[0].data[i] + "%" + '</span>')
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join('');
        }
      };
      var trafficChartCanvas = $("#doughnutChart2").get(0).getContext("2d");
      var trafficChart = new Chart(trafficChartCanvas, {
        type: 'doughnut',
        data: trafficChartData,
        options: trafficChartOptions
      });
      $("#doughnut-chart-legend2").html(trafficChart.generateLegend());
    }
  });
</script>
@if(session('Message'))
<script>
    $(document).ready(function() {
      'use strict';
      resetToastPosition();
      $.toast({
        heading: 'Warning',
        text: "{{ session('Message') }}",
        showHideTransition: 'slide',
        icon: 'warning',
        loaderBg: '#f96868',
        position: 'top-right'
    });

      function resetToastPosition() 
      {
      $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
      $(".jq-toast-wrap").css({
        "top": "",
        "left": "",
        "bottom": "",
        "right": ""
      }); //to remove previous position style
  }

        });
    </script>
@endif
@endsection