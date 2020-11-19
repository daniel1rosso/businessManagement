function grafico_espacio_disco(free,total){
    var data = [{
        label: "Disponible",
        data: total
    }, {
        label: "Utilizado",
        data: free
    }];

        $.plot($("#pie"), data, 
                {
                        series: {
                                pie: { 
                                        show: true,
                                        radius: 1,
                                        label: {
                                                show: true,
                                                radius: 2/3,
                                                formatter: function(label, series){
                                                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                                                },
                                                threshold: 0.1
                                        }
                                }
                        },
                        legend: {
                                show: false
                        },
                        colors: ["#95c832", "#D65C4F"]
                });
};