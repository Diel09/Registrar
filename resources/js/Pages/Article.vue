<template>
    <div>
      <h2>Data Entry Form</h2>
      <form @submit.prevent="submitData">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="formData.name">
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="formData.email">
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: {
          name: '',
          email: '',
        },
      };
    },
    methods: {
    async submitData() {
        try {
            const response = await axios.post('/api/insert-data', this.formData);
            console.log('Data inserted successfully', response.data);
            // You can handle success actions here.
        } catch (error) {
            console.error('Error inserting data:', error);
            // Handle errors, such as displaying validation errors or error messages.
        }
    },
},
  };
  </script>