<template>
    
<table class="table table-striped">
    <thead>
      <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Job Title</td>
        <td>City</td>
        <td>Country</td>
        <td colspan="3">Actions</td>
      </tr>
    </thead>
    <tbody>
         :key="index" v-for="(contact, index) in contacts"
      <tr>
        <td>{{}}</td>
        <td>{{}}</td>
        <td>{{}}</td>
        <td>{{}}</td>
        <td>{{}}</td>
        <td>{{}}</td>
        <td>
          <a href="#" class="btn btn-warning">Show </a>
        </td>
        <td>
          <a
            href="#"
            class="btn btn-primary"
            
            >Edit</a
          >
        </td>
        <td>
          <button
            class="btn btn-danger"
            type="button"
            
          >
            Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>