<template>
    <div class="container">
        <el-row class="mt-5">
            <el-card v-loading="trip_status_loading">
                    <div>
                        <el-select v-model="trip_status_filter" class="mx-3  py-3 center-align"
                                   @change="fetchTripStatusData">
                            <el-option
                                v-for="option in trip_status_options"
                                :key="option.value"
                                :label="option.label"
                                :value="option.value">
                            </el-option>
                        </el-select>
                    </div>

                <div class="mt-5">
                    <GChart
                        :data="tripsData"
                        :options="tripChartOptions"
                        type="PieChart"
                    />
                </div>
            </el-card>
        </el-row>

        <el-row class="mt-5">
            <el-card v-loading="sales_performance_loading">
                    <div>
                        <el-select v-model="sales_performance_filter" class="px-3 mx-3"
                                   @change="fetchSalesPerformanceData">
                            <el-option
                                v-for="option in sales_performance_options"
                                :key="option.value"
                                :label="option.label"
                                :value="option.value">
                            </el-option>
                        </el-select>
                    </div>

                    <div class="mt-5">
                        <GChart
                            :data="chartData"
                            :options="chartOptions"
                            type="LineChart"
                        />
                    </div>
            </el-card>
        </el-row>
    </div>
</template>

<script>
import {GChart} from 'vue-google-charts';

export default {

    props: {
        sales_performance_options: {type: Array},
        trip_status_options: {type: Array},
    },

    data() {
        return {
            sales_performance_filter: '',
            trip_status_filter: '',
            chartData: [],
            tripsData: [],
            chartOptions: {
                chart: {
                    title: 'Sales Performance',
                    curveType: 'function',
                    legend: {position: 'bottom'}
                }
            },
            tripChartOptions: {
                chart: {
                    title: 'Trip Status',
                    pieHole: 0.4,
                },
            },
            trip_status_loading: false,
            sales_performance_loading: false,
        };
    },

    created() {
        this.fillData();
    },

    methods: {
        fillData() {
            this.trip_status_filter = this.trip_status_options[0].value;
            this.sales_performance_filter = this.sales_performance_options[0].value;
            this.fetchSalesPerformanceData();
            this.fetchTripStatusData();
        },

        fetchTripStatusData() {
            this.trip_status_loading = true;
            axios.get('api/trips-status', {params: {filter: this.trip_status_filter}})
                .then((response) => {
                    this.tripsData = response.data;
                }).catch((err) => {
                this.$message.error('Oops, this is a error message.');
            }).finally(() => {
                this.trip_status_loading = false;
            })
        },

        fetchSalesPerformanceData() {
            this.sales_performance_loading = true;
            axios.get('api/sales-performance', {params: {filter: this.sales_performance_filter}})
                .then((response) => {
                    this.chartData = response.data;
                }).catch((err) => {
                this.$message.error('Oops, this is a error message.');
            }).finally(() => {
                this.sales_performance_loading = false;
            })
        }
    }
}
</script>
