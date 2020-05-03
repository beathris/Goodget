
$(document).ready(function (){
    $.ajax({
        url : "/api/dashboard/laporan-pendapatan",
        type : "GET",
        dataType : "JSON",
        success : function(result){
            console.log(result)

            var Data=[];
            for(var i=0; i<result.length; i++){
                Data[i] = parseInt(result[i]['total']);
            }
            console.log(Data);

            if($('#grafik-pendapatan').length){
                var date = new Date();
                Highcharts.chart('grafik-pendapatan'),{
                    chart:{
                        type: 'column'
                    },
                    title:{
                        text:'Grafik Pendapatan Perusahaan Goodget ' + date
                    },
                    subtitle:{
                        text: 'laracms'

                    },
                    xAxis:{
                        categories:[
                            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'
                        ],
                        crosshair:true
                    },
                    yAxis:{
                        min: 0,
                        title :{
                            text: 'Jumlah Pendapatan'
                        }
                    },
                    plotOptions:{
                        column : {
                            pointPadding : 0.2,
                            borderWidth : 0
                        }
                    },
                    series: [
                        {
                            name: 'pendapatan',
                            data: Data
                        
                        }
                    ]
                }
            }
        }

    });
});