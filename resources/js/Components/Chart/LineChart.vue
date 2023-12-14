<template>
  <Line
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
    :key="lineKey"
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
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep' , 'Oct', 'Nov', 'Dec'],
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
      },
      lineKey: 0
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
        this.chartData.datasets[0].data = response.data.request;
        this.lineKey += 1;
      } catch (error) {
        console.error('Error fetching data from the database:', error);
      }
    }
  }
}
</script>