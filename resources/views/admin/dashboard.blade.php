@extends('admin.layouts.gen')
@section('title', 'Glory Admin Panel')

@section('links')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="http://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
@endsection

@section('content')

<section class="container" style="width:77.5%; float:left;">
        <div class="row">
        <div class="col-md-3">
          <div class="card-counter primary">
            <i class="fa fa-code-fork"></i>
            <span class="count-numbers">12</span>
            <span class="count-name">Flowz</span>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="card-counter danger">
            <i class="fa fa-ticket"></i>
            <span class="count-numbers">599</span>
            <span class="count-name">Instances</span>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="card-counter success">
            <i class="fa fa-database"></i>
            <span class="count-numbers">6875</span>
            <span class="count-name">Data</span>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="card-counter info">
            <i class="fa fa-users"></i>
            <span class="count-numbers">35</span>
            <span class="count-name">Users</span>
          </div>
        </div>
      </div>

      <div class="row">
            <div class="col-md-6">
                    {!! $chart->container() !!}
              </div>
              <div class="col-md-6">
                    {!! $chartone->container() !!}
                    
              </div>
      </div>

      <div class="row">
          <div class="col-md-6">
                <div class="row">
                        <div class="progress" data-percentage="20">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">
                                    <div>
                                        20%<br>
                                        <span>completed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress" data-percentage="20">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            20%<br>
                                            <span>completed</span>
                                        </div>
                                    </div>
                                </div>
                              
                </div>
                <div class="row">
                        <div class="progress" data-percentage="20">
                                <span class="progress-left">
                                    <span class="progress-bar"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar"></span>
                                </span>
                                <div class="progress-value">
                                    <div>
                                        20%<br>
                                        <span>completed</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress" data-percentage="20">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            20%<br>
                                            <span>completed</span>
                                        </div>
                                    </div>
                                </div>
                </div>
                  
          </div>
            <div class="col-md-6">
                    {!! $charttwo->container() !!}
            </div>


            
      </div>
     

</section>
    
{!! $chart->script() !!}
{!! $chartone->script() !!}
{!! $charttwo->script() !!}

@endsection


