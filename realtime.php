<div class="header header-realtime">
    <a>Realtime</a>
    <div id="date">

    </div>
</div>

<div class="main-realtime">

    <div class="main-right">

        <div class="card-langgam">
            <div class="header-card-langgam">
                <span class="card-name-right">Langgam Beban Timor</span>
                <div class="legends">
                    <span class="red"><i class='bx bxs-circle'></i> Realisasi</span>
                    <span class="blue"><i class='bx bxs-circle'></i> Prediksi</span>
                </div>
            </div>
            <div class="box-chart">
                <canvas id="chart"></canvas>
            </div>
        </div>

        <div class="card-donnut">
            <div class="header-card-donnut">
                <span class="card-name-right">Bauran Energi Sistem Timor</span>
            </div>
            <hr>
            <div class="box-chart-donut">

                <div class="donut">
                    <div class="chart-donut"> 
                    <canvas id="chart-donut"></canvas>
                    </div>
                    <div class='legends-donut'>
                        <span class="kuning"><i class='bx bxs-circle'></i> Batubara</span>
                        <span class="biru-muda"><i class='bx bxs-circle'></i> B30</span>
                        <span class="biru-tua"><i class='bx bxs-circle'></i> MFO</span>
                        <span class="orange"><i class='bx bxs-circle'></i> Surya</span>
                    </div>
                </div> 

                <div class="box-table">

                    <table class="table-donut">
                        <thead>
                            <tr>
                                <th>pembangkit</th>
                                <th>Bauran Energi</th>
                                <th>Beban Energi</th>
                                <th>%</th>
                            </tr>
                        </thead>

                        <tbody id = "bauran_energe_timor">
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

        <!-- 
        <div class="card-pie">
            <div class="header-card-donnut">
                <span class="card-name-right">Biaya Energi Sistem Timor</span>
            </div>            
            <hr>
            <div class="box-chart-donut">

                <div class="donut">
                    <div id="chart-pie"></div>
                    <div class='legends-donut'>
                    <span class="kuning"><i class='bx bxs-circle'></i> Batubara</span>
                    <span class="biru-muda"><i class='bx bxs-circle'></i> HFO</span>
                    <span class="biru-tua"><i class='bx bxs-circle'></i> HSD</span>
                    <span class="orange"><i class='bx bxs-circle'></i> Surya</span>
                    </div>
                </div>

                <div class="box-table">
                    
                    <table class="table-donut">
                        <thead>
                            <tr>
                                <th>Biaya</th>
                                <th>nilai</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                            <tr>
                                <td>PLTU PLN BOLOK 1</td>
                                <td>15.57</td>
                            </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div> -->

    </div>

    <div class="main-left">
        <div id="card_left"></div>
    </div>

</div>
<script src="assets/js/realtime.js"></script>