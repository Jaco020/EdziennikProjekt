var wykresObiekt = document.getElementById("wykresFrekfencja").getContext("2d");
const uczenGodzinyData = [2,0,30];
Chart.defaults.font.size = 15;
var wykresFrekfencja = new Chart(wykresObiekt,{
    type: 'bar',
    data: {
        labels:["Nieobecności",["Wniosek", "o usprawiedliwienie"],"Usprawiedliwone"],
        datasets: [{
            label:'Godziny',
            data:uczenGodzinyData,
            backgroundColor:"#2456e0"// --blue-500
        }]
    },
    options:{
        scales:{
            y:{
                max:Math.max(...uczenGodzinyData)+5,
                ticks: {
                    stepSize: 5
                }
            }
        },
        plugins:{
            legend:{
                display:false,
            }
        }
    }
});