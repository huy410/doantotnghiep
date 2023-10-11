<!-- load file layout chung -->
@extends('admin.layout')
@section('content')

<div style="display: flex">
  <div style="width: 600px;  margin-right: 50px">
    <canvas id="myChart"></canvas>
  </div>
  <div style="width: 600px">
    <canvas id="myChart3"></canvas>
  </div>
</div>

  @foreach ($statistics as $statistic)
    @for ($i = 0; $i < 7; $i++) 
        @if (strtotime($statistic->created_at) == strtotime(date("Y-m-d"))-86400*$i )
          <input type="hidden" id="money{{ $i }}" value="{{ $statistic->total_money}}">
          <input type="hidden" id="order{{ $i }}" value="{{ $statistic->total_order}}">
        @endif
    @endfor
  @endforeach

  @for ($i = 0; $i < 7; $i++) 
    <input type="hidden" id="money{{ $i }}" value="0">
    <input type="hidden" id="order{{ $i }}" value="0">
  @endfor

    <script>
      let money = [];
      let order = [];
      
      for(let i=0; i<7; i++) {
        money[i] = document.querySelector("#money"+i).value;
        order[i] = document.querySelector("#order"+i).value;
      }
      const labels = [
        "{{ date('d/m',strtotime(now())-86400*6) }}",
        "{{ date('d/m',strtotime(now())-86400*5) }}",
        "{{ date('d/m',strtotime(now())-86400*4) }}",
        "{{ date('d/m',strtotime(now())-86400*3) }}",
        "{{ date('d/m',strtotime(now())-86400*2) }}",
        "{{ date('d/m',strtotime(now())-86400) }}",
        "{{ date('d/m',strtotime(now())) }}",
    ];
    const data = {
      labels: labels,
      datasets: [{
        label: 'Tổng doanh thu',
        backgroundColor: '#287dfa',
        borderColor: '#287dfa',
        data: money.reverse(),
      }],
    };
    const config = {
      type: 'line',
      data: data,
      options: {}
    };
    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    </script>

    <script>
      const data3 = {
        labels: labels,
        datasets: [{
          label: 'Tổng đơn hàng',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: order.reverse(),
        }],
      };
      const config3 = {
        type: 'line',
        data: data3,
        options: {}
      };
      var myChart = new Chart(
        document.getElementById('myChart3'),
        config3
      );
    </script>

    
    <?php 
      $i = 0;
      //sum top 4 order quantity
      $sumQuantity = 0;
      //sum top 4 total money
      $sumMoney = 0;
    ?>

    @foreach ($categories as $category)
        <input type="hidden" id="categoryName{{$i}}" value="{{ $category->name; }}">
        <input type="hidden" id="orderQuantity{{$i}}" value="{{ $category->orderQuantity; }}">
        <input type="hidden" id="totalMoney{{$i}}" value="{{ $category->totalMoney; }}">

        <?php 
          $i++;
          $sumQuantity += $category->orderQuantity;
          $sumMoney += $category->totalMoney;       
        ?>
    @endforeach

    <input type="hidden" id="countCategory" value="{{ $i }}">
    <input type="hidden" id="orderQuantityRemain" value="{{ $sumOrderQuantity->orderQuantity - $sumQuantity }}">
    <input type="hidden" id="moneyRemain" value="{{ $sumOrderQuantity->totalMoney - $sumMoney }}">


    <div style="display: flex; margin-top: 50px;">
      <div style="width: 600px;  margin-right: 50px">
        <canvas id="myChart2"></canvas>
      </div>
      <div style="width: 600px">
        <canvas id="myChart4"></canvas>
      </div>
    </div>

    <script>
      let categoryName = [];
      let orderQuantity = [];
      let totalMoney = [];

      for(let i=0; i< document.querySelector("#countCategory").value; i++) {
        categoryName[i] = document.querySelector("#categoryName"+i).value;
        orderQuantity[i] = document.querySelector("#orderQuantity"+i).value;
        totalMoney[i] = document.querySelector("#totalMoney"+i).value;
      }
      
      categoryName.push('khác');
      orderQuantity.push(document.querySelector('#orderQuantityRemain').value);
      totalMoney.push(document.querySelector('#moneyRemain').value);


      const data2 = {
        labels: categoryName, 
        datasets: [
          {
            label: labels,
            data: orderQuantity,
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
              "#9ACD32",
              "orange",  
            ],
            borderColor: [
              'white',
            ],
            borderWidth: [1, 1, 1, 1, 1]
          }
        ]
      };
      const config2 = {
        type: 'doughnut',
        data: data2,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'So sánh số lượng sản phẩm bán được theo danh mục sản phẩm'
            }
          }
        },
      };
      var myChart2 = new Chart(
          document.getElementById('myChart2'),
          config2
        );
    </script>


    <script>
      
      const data4 = {
        labels: categoryName, 
        datasets: [
          {
            label: labels,
            data: totalMoney,
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
              "#9ACD32",
              "orange",  
            ],
            borderColor: [
              'white',
            ],
            borderWidth: [1, 1, 1, 1, 1]
          }
        ]
      };
      const config4 = {
        type: 'doughnut',
        data: data4,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'So sánh doanh thu bán được theo danh mục sản phẩm'
            }
          }
        },
      };
      var myChart4 = new Chart(
          document.getElementById('myChart4'),
          config4
        );
    </script>

@endsection