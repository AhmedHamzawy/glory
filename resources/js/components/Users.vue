<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New Users
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p v-if="verrors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in verrors" :key="error">{{ error }}</li>
    </ul>
    </p>
    <form @submit.prevent="addUser" class="mb-3">
      <div class="form-group">
        <input type="text" name="user_name" v-validate="'required'" class="form-control" placeholder="User Name" v-model="user.user_name">
        <span>{{ errors.first('user_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="first_name" v-validate="'required'" class="form-control" placeholder="First Name" v-model="user.first_name">
        <span>{{ errors.first('first_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="middle_name" v-validate="'required'" class="form-control" placeholder="Middle Name" v-model="user.middle_name">
        <span>{{ errors.first('middle_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="last_name" v-validate="'required'" class="form-control" placeholder="Last Name" v-model="user.last_name">
        <span>{{ errors.first('last_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="gender" v-validate="'required'" class="form-control" placeholder="Gender" v-model="user.gender">
        <span>{{ errors.first('gender') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="birthdate" v-validate="'required'" class="form-control" placeholder="Birthdate" v-model="user.birthdate">
        <span>{{ errors.first('birthdate') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="age" v-validate="'required'" class="form-control" placeholder="Age" v-model="user.age">
        <span>{{ errors.first('age') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="telephone" v-validate="'required'" class="form-control" placeholder="Telephone" v-model="user.telephone">
        <span>{{ errors.first('telephone') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="email" v-validate="'required'" class="form-control" placeholder="Email" v-model="user.email">
        <span>{{ errors.first('email') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="address" v-validate="'required'" class="form-control" placeholder="Address" v-model="user.address">
        <span>{{ errors.first('address') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="street" v-validate="'required'" class="form-control" placeholder="Street" v-model="user.street">
        <span>{{ errors.first('street') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="town" v-validate="'required'" class="form-control" placeholder="town" v-model="user.town">
        <span>{{ errors.first('town') }}</span>
      </div>
      <div class="form-group">
        <select v-model="user.country">
          <option v-for="country in countries" v-bind:key="country.id" :value="country.id">
            {{ country.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <textarea name="other" v-validate="'required'" class="form-control" placeholder="other" v-model="user.other" ></textarea>
        <span>{{ errors.first('other') }}</span>
      </div>
      <div class="form-group">
        <input type="password" name="password" v-validate="'required'" class="form-control" placeholder="Password" v-model="user.password">
        <span>{{ errors.first('password') }}</span>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <h2>Users</h2>
    
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>


      
    
           <tr v-for="user in users" v-bind:key="user.id">
      <th scope="row">{{ user.id }}</th>
      <td>{{ user.user_name }}</td>
      <td> <button @click="editUser(user)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteUser(user.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      users: [],
      countries: [],
      user: {
        id: '',
        user_name: '',
      },
      user_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchUsers();
    this.fetchCountries();
  },
  methods: {
    fetchUsers(page_url) {
      let vm = this;
      page_url = page_url || '../api/users';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    fetchCountries(countries_url){
      countries_url =  countries_url || '../api/countries';
      fetch(countries_url)
        .then(res => res.json())
        .then(res => {
          this.countries = res;
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteUser(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../api/users/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('User Removed');
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    addUser() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/users', {
          method: 'post',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('User Added');
            this.fetchUsers();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/users', {
          method: 'put',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('User Updated');
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    editUser(user) {
      this.edit = true;
      this.user.id = user.id;
      this.user.user_id = user.id;
      this.user.user_name = user.user_name;
      this.user.first_name = user.first_name;
      this.user.middle_name = user.middle_name;
      this.user.last_name = user.last_name;
      this.user.gender = user.gender;
      this.user.birthdate = user.birthdate;
      this.user.age = user.age;
      this.user.telephone = user.telephone;
      this.user.email = user.email;
      this.user.address = user.address;
      this.user.street = user.street;
      this.user.town = user.town;
      this.user.country = user.country;
      this.user.other = user.other;
      this.user.password = user.password;

      
    },
    clearForm() {
      this.edit = false;
      this.user.id = null;
      this.user.user_id = null;
      this.user.user_name = '';
      this.user.first_name = '';
      this.user.middle_name = '';
      this.user.last_name = '';
      this.user.gender = '';
      this.user.birthdate = '';
      this.user.age = '';
      this.user.telephone = '';
      this.user.email = '';
      this.user.address = '';
      this.user.street = '';
      this.user.town = '';
      this.user.country = '';
      this.user.other = '';
      this.user.password = '';

      
    },
    validation(){
      this.verrors = [];
      if(this.user.user_name === ''){this.verrors.push('Please Add The User Name');}
      if(this.user.first_name === ''){this.verrors.push('Please Add The First Name');}
      if(this.user.middle_name === ''){this.verrors.push('Please Add The Middle Name');}
      if(this.user.last_name === ''){this.verrors.push('Please Add The Last Name');}
      if(this.user.gender === ''){this.verrors.push('Please Add The Gender');}
      if(this.user.birthdate === ''){this.verrors.push('Please Add The Birthdate');}
      if(this.user.age === ''){this.verrors.push('Please Add The Age');}
      if(this.user.telephone === ''){this.verrors.push('Please Add The Telephone');}
      if(this.user.email === ''){this.verrors.push('Please Add The Email');}
      if(this.user.address === ''){this.verrors.push('Please Add The Address');}
      if(this.user.street === ''){this.verrors.push('Please Add The Street');}
      if(this.user.town === ''){this.verrors.push('Please Add The Town');}
      if(this.user.country === ''){this.verrors.push('Please Add The Country');}
      if(this.user.other === ''){this.verrors.push('Please Add The Other');}
      if(this.user.password === ''){this.verrors.push('Please Add The Password');}

      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>