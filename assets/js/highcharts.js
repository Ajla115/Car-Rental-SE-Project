var highChart = {

    chartTable: function() {
        $.ajax({
            url: 'rest/visitors',
            method: 'GET',
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
            },
            success: function(data) {
                let categories = [];
                let menData = [];
                let womenData = [];
    
                data.forEach(item => {
                    categories.push(item.categories);
                    menData.push(parseInt(item.men));
                    womenData.push(parseInt(item.women));
                });
    
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Rented cars by gender'
                    },
                    xAxis: {
                        categories: categories
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Number of Rented Cars(%)'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    plotOptions: {
                        column: {
                            stacking: 'percent'
                        }
                    },
                    series: [{
                        name: 'Men',
                        data: menData
                    }, {
                        name: 'Women',
                        data: womenData
                    }]
                });
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    },
};
    
