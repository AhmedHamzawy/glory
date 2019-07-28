<template>
  <div>


    <h2>Users</h2>
    
    {{ user.user_name }}


   
    
  </div>
</template>

<script>
export default {
  props: ['id'],  
  data() {
    return {
      user: {
        id: '',
        user_name: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        gender: '', 
        birthdate: '',
        age: '', 
        telephone: '',
        email: '',
        address: '' ,
        street: '', 
        town: '', 
        country: '', 
        other: ''
      },
    };
  },
   created() {
    this.fetchUser();
  },
  methods: {
    fetchUser() {
    
      fetch(`../../api/users/${this.id}`)
        .then(res => res.json())
        .then(res => {
            this.user.user_name = res.user_name;
        })
        .catch(err => console.log(err));
    },
    
  }
};
</script>