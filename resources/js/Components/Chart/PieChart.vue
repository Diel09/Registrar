<template>
    <Pie
      id="my-chart-id"
      :options="chartOptions"
      :data="chartData"
      :key="componentKey"
    />
</template>

<script>
import { Pie } from 'vue-chartjs';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import axios from 'axios';

ChartJS.register(ArcElement, Tooltip, Legend);

export default {
  name: 'Piechart',
  components: { Pie },
  data() {
    return {
      label: [],
      num: [],
      arr: [],
      componentKey: 0,
      chartData: {
        labels: [],
        datasets: [
            {
              backgroundColor: ['#41B883', '#E46651', '#00D8FF'],
              data: [],
            },
          ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    }
  },
  mounted() {
    this.fetchDataFromDatabase();
  },
  methods: {
    async fetchDataFromDatabase() {
      try {
        const response = await axios.get('/fetchDoctypes');
        this.arr = response.data;
        //agloop ta dtuy
        this.arr.forEach((value, index) => {
          this.label.push(value.label);
          this.num.push(value.number);
        });
        this.chartData.labels = this.label;
        this.chartData.datasets[0].data = this.num;
        this.componentKey += 1;
      } catch (error) {
        console.error('Error fetching data from the database:', error);
      }
    },
  }
};
</script>