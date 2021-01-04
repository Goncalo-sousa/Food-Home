<template>
  <div>
    <global-messages></global-messages>
    <manage-users v-bind:users="users" @delete-user="deleteUser" />

    <edit-user
      v-if="editingUser"
      :user="currentUser"
      @cancel-edit="cancelEdit"
      @save-user="saveUser"
    />
  </div>
</template>

<script>
  //props: ["user"],
  
import manageUsers from "./manageUsers.vue";
import MessageComponent from '../Messages/globalMessages.vue'
export default {

  components: { manageUsers, 'global-messages': MessageComponent },
  data: function () {
    return {
      users: [],
      editingUser: false,
      currentUser: {},
    };
  },
  methods: {
    editUser: function (user) {
      this.currentUser = Object.assign({}, user);
      this.editingUser = true;
    },
    deleteUser: function (user) {
      console.log(user);
      axios.delete(`/api/users/${user.id}`).then((result) => {
        this.users.splice(
          this.users.findIndex((u) => u.id == user.id),
          1
        );
      });
    },
    
  },
  sockets: {
    connect () {
      // If user is logged resend the message user_logged
      if (this.$store.state.user) {
        this.$socket.emit('user_logged', this.$store.state.user)
      }
    },
    private_message (payload) {
      this.$toasted.show('Message from "' + payload.originalUser.name +
        '":<br><br>' + payload.message, { type: 'info' })
    },
    destination_user_not_logged (payload) {
      this.$toasted.show('User "' + payload.destinationUser.name + '" is not available!',
        { type: 'warning' })
    }
  },
  async mounted() {
    await axios.get("api/users").then((response) => {
      this.users = response.data.data;
    });
  },
};
</script>

<style></style>
