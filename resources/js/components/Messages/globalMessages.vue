<template>
  <div>
    <h4>Global Messages</h4>
    <div>
      <input
        type="text"
        class="msgInputs"
        v-model="msgText"
        @keypress.enter="sendMsgText"
      >
      <div class="div-radio">
        Send message to:
        <input
          type="radio"
          id="destination_all"
          value="everybody"
          v-model="msgDestination"
        >
        <label for="destination_all">Everybody</label>
        <input
          type="radio"
          id="destination_normal"
          value="normal"
          v-model="msgDestination"
        >
        <label for="destination_normal">Cookers</label>
        <input
          type="radio"
          id="destination_admin"
          value="admin"
          v-model="msgDestination"
        >
        <label for="destination_admin">Delivery Man</label>
      </div>
    </div>
    <div>
      <textarea
        rows="4"
        class="msgInputs"
        v-model="allMsgText"
      >
      Global Chat
      </textarea>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      msgText: '',
      allMsgText: '',
      msgDestination: 'everybody'
    }
  },
  methods: {
    sendMsgText () {
      let payload = {
        user: this.$store.state.user,
        destination: this.msgDestination,
        message: this.msgText
      }
      this.$socket.emit('global_message', payload)
      this.msgText = ''
    }
  },
  sockets: {
    global_message (payload) {
      let newLine = payload.user ? payload.user.name : '(Anonymous)'
      newLine += ' said: ' + payload.message + '\n'
      this.allMsgText += newLine
    }
  }
}
</script>

<style scoped>
.msgInputs {
  width: 100%;
}
.div-radio {
  margin-top: 10px;
  margin-bottom: 2px;
}
input[type="radio"] {
  margin-left: 10px;
}
</style>
