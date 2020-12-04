<template>
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user of users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>

          <!-- <td>
            <button class="btn btn-primary" v-on:click="editUser(user)">
              Edit
            </button>
            <button class="btn btn-danger" @click="deleteUser(user)">
              Delete
            </button>
          </td> -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
 data: function () {
    return {
      title: "List Users",
      users: [],
    };
  },
   mounted() {
    axios.get("api/users").then((response) => {
      this.users = response.data.data;
    });
   }
}
</script>

<style>

</style>