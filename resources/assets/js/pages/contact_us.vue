<template>
  <div id="contact_us">
    <div class="col-4 col-sm-12" id="formWrapper">
      <form method="POST" v-on:submit.prevent="submitForm()">
        <h3>GET IN TOUCH</h3>
        <hr style="width:75px;height:2px;background-color:#fff;margin-top:45px;margin-bottom:45px;" />

        <input type="text" required v-model="form.name" class="form-control" placeholder="Name*" />
        <input type="text" required v-model="form.email" class="form-control" placeholder="Email*" />
        <input type="text" required v-model="form.subject" class="form-control" placeholder="Subject*" />
        <textarea v-model="form.message" class="form-control" placeholder="Your Message"></textarea>

        <button type="submit" class="btn btn-success" style="width:100%;margin-top:15px;">Send</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'
var methods = {}

methods.submitForm = function () {
  const postData = {
    form: this.form
  }
  axios.post('/api/submitContactRequest', postData).then(response => {
    if (response.status === 201 || response.status === 200) {
      swal('Success!', 'We have received your message and will get back with you as soon as possible.', 'success')
      this.form = {
        name: '',
        email: '',
        subject: '',
        message: ''
      }
    }
  })
}

export default {
  name: 'ContactUs',

  data: function () {
    return {
      form: {
        name: '',
        email: '',
        subject: '',
        message: ''
      }
    }
  },

  methods: methods
}
</script>
<style lang="scss" scoped>
#contact_us {
  width: 100%;
  background-color: #000;
  height: auto;
  padding-bottom:80px;


  #formWrapper {
    margin-left: auto;
    margin-right: auto;
    text-align:center;
    max-width: 400px;

    h3 {
      color: #fff;
      padding-top: 25px;
      font-weight:bold;
    }

    form {
      width:100%;

      input {
        margin-top: 15px;
      }
      textarea {
        margin-top: 15px;
      }
    }
  }
}
</style>
