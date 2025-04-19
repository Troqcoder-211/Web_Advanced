<div class="flex  h-[100vh] w-full">
    <div class="grid grid-rows-[6fr_4fr] gap-2 w-full">
        <div class="flex w-full">
            <div class="grid grid-cols-[6fr_3fr] gap-2 w-full  h-full">
                <div class="border-0 bg-white rounded-md">
                    <canvas id="lineChart" class=" h-full w-full" role="image">Hi </canvas>
                    <script>
                        const DATA_COUNT = 4;
                        const NUMBER_CFG = {
                            count: DATA_COUNT,
                            min: 0,
                            max: 100
                        };
                        const labels = [
                            'January',
                            'February',
                            'March',
                            'April',
                            'June',
                            'July',
                            'August'

                        ];
                        const numm2 = [20, 30, 40, 50, 0, 70, 100];
                        const num = [10, 50, 60, 80, 20, 58, 10];
                        const data = {
                            labels: labels,
                            datasets: [{
                                    label: 'Dataset 1',
                                    data: num,
                                    borderColor: 'rgb(255, 99, 132)',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                },
                                {
                                    label: 'Dataset 2',
                                    data: numm2,
                                    borderColor: 'rgb(54, 162, 235)',
                                    backgroundColor: 'rgb(54, 162, 235)',
                                }
                            ]
                        };
                        const config = {
                            type: 'line',
                            data: data,
                            options: {
                                responsive: false,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Chart.js Line Chart'
                                    }
                                }
                            },
                        };
                        new Chart('lineChart', config);
                    </script>
                </div>
                <div class="grid grid-rows-2 gap-2 ">
                    <div class="border-0 rounded-md bg-[#ff9f1a] flex flex-col p-3">
                        <p class="text-white text-3xl font-medium text-center">Doanh thu</p>
                        <div class="flex items-center gap-10 p-2" style="flex-grow:1;"><i class="fa-solid fa-dollar-sign text-5xl text-[#32ff7e]"></i>
                            <div class="flex items-center">

                                <p class="text-2xl font-medium text-[#3ae374]">360.000.000 VND</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-0 rounded-md bg-[#7d5fff] p-3 text-white flex flex-col">
                        <p class="text-3xl font-medium text-center ">Tăng trưởng </p>
                        <div class="flex items-center gap-10 p-2" style="flex-grow:1;"><i class="fa-solid fa-chart-line text-6xl"></i>
                            <div class="flex items-center">
                                <p class="text-5xl font-medium text-[#32ff7e]">+36</p><i class="fa-solid fa-percent text-4xl text-[#32ff7e]"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#F5DAFF] border-0 rounded-md ">
            <canvas id="doughChart" class=" " style="" role="image">Hi </canvas>
            <script>
                const datacount = 2;
                const number = {
                    count: DATA_COUNT,
                    min: 0,
                    max: 60
                };

                const dataa = {
                    labels: ['Red', 'Orange'],
                    datasets: [{
                        label: 'Dataset 1',
                        data: [10, 50],
                        backgroundColor: ['rgb(255, 159, 64)', 'rgb(255, 99, 132)'],
                    }]
                };

                const configg = {
                    type: 'doughnut',
                    data: dataa,
                    options: {
                        responsive: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Chart.js Doughnut Chart'
                            }
                        }
                    },
                };
                new Chart('doughChart', configg)
            </script>
        </div>
    </div>

</div>