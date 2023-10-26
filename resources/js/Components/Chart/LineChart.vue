<template>
  <Line
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend } from 'chart.js'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

export default {
  name: 'LineChart',
  components: { Line },
  data() {
    return {
      chartData: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Completed',
            backgroundColor: '#bbf7d0',
            labelColor:'red',
            data: [40, 39, 10, 40, 39, 80, 40],
            borderColor: 'green',
            borderWidth:'5',
            hoverBackgroundColor:'red',
            pointBorderWidth:'5',
            pointBorderColor:'#86efac'

          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  }
}
</script>