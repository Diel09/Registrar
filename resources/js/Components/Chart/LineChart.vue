<template>
  <Line
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
    :key="componentKey"
  />
</template>

<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend } from 'chart.js'
import axios from 'axios';  // Import axios

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

export default {
  name: 'LineChart',
  components: { Line },
  data() {
    return {
      chartData: {
        labels: ['2023'],
        datasets: [
          {
            label: 'Completed',
            backgroundColor: '#bbf7d0',
            labelColor: 'red',
            data: [],
            borderColor: 'green',
            borderWidth: '5',
            hoverBackgroundColor: 'red',
            pointBorderWidth: '5',
            pointBorderColor: '#86efac'
          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },
  mounted() {
    this.fetchCompleted();
  },
  methods: {
    async fetchCompleted() {
      try {
        const response = await axios.get('/line-Chart');
        console.log('Fetched data:', response.data);
        this.chartData.datasets[0].data = response.data.data;
        this.componentKey += 1;
      } catch (error) {
        console.error('Error fetching data from the database:', error);
      }
    }
  }
}
</script>