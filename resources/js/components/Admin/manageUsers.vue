<template>
  <div class="manage-users">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Type</th>
          <th>Blocked</th>
          <th>Photo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user of users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.type }}</td>
          <td>{{ user.blocked }}</td>
          <th>
            <img
              v-if="user.photo_url != null"
              v-bind:src="'storage/fotos/' + user.photo_url"
              width="50vw"
              height="50vh"
            />
          </th>
          <td>
            <button class="btn btn-primary" v-on:click="editUser(user)">
              Edit
            </button>
            <button class="btn btn-danger" @click="deleteUser(user)">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ["users"],
  methods: {
    editUser(user) {
      this.$router.push({ path: `/users/${user.id}` });
    },
    deleteUser(user) {
      this.$emit("delete-user", user);
      
    },
  },
};
</script>

<style>
</style>