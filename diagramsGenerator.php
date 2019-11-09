<script>

    /* Диаграмма первой главы */

    if($("#chartChapter1").length){
        var f=document.getElementById("chartChapter1");
        var dataName = eval(<?php echo $jsonChapter1ItemName; ?>);
        var dataStart = eval(<?php echo $jsonChapter1StartValue; ?>);
        var dataFinish = eval(<?php echo $jsonChapter1FinishValue; ?>);
        new Chart(f,{type:"bar",data:{
                labels:dataName,
                datasets:[{label:"Начало отчетного периода",backgroundColor:"#26B99A", data:dataStart},
                    {label:"Конец отчетного периода",backgroundColor:"#03586A", data:dataFinish}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    /* Диаграмма второй главы */

    if($("#chartChapter2").length){
        var f=document.getElementById("chartChapter2");
        var dataName = eval(<?php echo $jsonChapter2ItemName; ?>);
        var dataStart = eval(<?php echo $jsonChapter2StartValue; ?>);
        var dataFinish = eval(<?php echo $jsonChapter2FinishValue; ?>);
        new Chart(f,{type:"bar",data:{
                labels:dataName,
                datasets:[{label:"Начало отчетного периода",backgroundColor:"#26B99A", data:dataStart},
                    {label:"Конец отчетного периода",backgroundColor:"#03586A", data:dataFinish}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    /* Диаграмма третьей главы */

    if($("#chartChapter3").length){
        var f=document.getElementById("chartChapter3");
        var dataName = eval(<?php echo $jsonChapter3ItemName; ?>);
        var dataStart = eval(<?php echo $jsonChapter3StartValue; ?>);
        var dataFinish = eval(<?php echo $jsonChapter3FinishValue; ?>);
        new Chart(f,{type:"bar",data:{
                labels:dataName,
                datasets:[{label:"Начало отчетного периода",backgroundColor:"#26B99A", data:dataStart},
                    {label:"Конец отчетного периода",backgroundColor:"#03586A", data:dataFinish}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    /* Диаграмма четвертой главы */

    if($("#chartChapter4").length){
        var f=document.getElementById("chartChapter4");
        var dataName = eval(<?php echo $jsonChapter4ItemName; ?>);
        var dataStart = eval(<?php echo $jsonChapter4StartValue; ?>);
        var dataFinish = eval(<?php echo $jsonChapter4FinishValue; ?>);
        new Chart(f,{type:"bar",data:{
                labels:dataName,
                datasets:[{label:"Начало отчетного периода",backgroundColor:"#26B99A", data:dataStart},
                    {label:"Конец отчетного периода",backgroundColor:"#03586A", data:dataFinish}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    /* Диаграмма пятой главы */

    if($("#chartChapter5").length){
        var f=document.getElementById("chartChapter5");
        var dataName = eval(<?php echo $jsonChapter5ItemName; ?>);
        var dataStart = eval(<?php echo $jsonChapter5StartValue; ?>);
        var dataFinish = eval(<?php echo $jsonChapter5FinishValue; ?>);
        new Chart(f,{type:"bar",data:{
                labels:dataName,
                datasets:[{label:"# Начало отчетного периода",backgroundColor:"#26B99A", data:dataStart},
                    {label:"# Конец отчетного периода",backgroundColor:"#03586A", data:dataFinish}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    if($("#solvencyReport").length){
        var f=document.getElementById("solvencyReport");
        var K1start = eval(<?php echo $jsonK1start; ?>);
        var K1finish = eval(<?php echo $jsonK1finish; ?>);
        var K2start = eval(<?php echo $jsonK2start; ?>);
        var K2finish = eval(<?php echo $jsonK2finish; ?>);
        var K3start = eval(<?php echo $jsonK3start; ?>);
        var K3finish = eval(<?php echo $jsonK3finish; ?>);
        new Chart(f,{type:"bar",data:{
                labels: ['K1', 'K2', 'K3'],
                datasets:[{label:"# Начало отчетного периода",backgroundColor:"#26B99A", data:[K1start, K2start, K3start]},
                    {label:"# Конец отчетного периода",backgroundColor:"#03586A", data:[K1finish, K2finish, K3finish]}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }

    if($("#financialStablilityReport").length){
        var f=document.getElementById("financialStablilityReport");
        var K4start = eval(<?php echo $jsonK4start; ?>);
        var K4finish = eval(<?php echo $jsonK4finish; ?>);
        var K5start = eval(<?php echo $jsonK5start; ?>);
        var K5finish = eval(<?php echo $jsonK5finish; ?>);
        new Chart(f,{type:"bar",data:{
                labels: ['K4', 'K5'],
                datasets:[{label:"# Начало отчетного периода",backgroundColor:"#26B99A", data:[K4start, K5start]},
                    {label:"# Конец отчетного периода",backgroundColor:"#03586A", data:[K4finish, K5finish]}]
            },
            options:{scales:{yAxes:[{ticks:{beginAtZero:!0}}]}}})
    }
</script>