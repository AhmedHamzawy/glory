<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add Role</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
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
    <form @submit.prevent="addRole" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="role.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="display_name" v-validate="'required'" class="form-control" placeholder="Display Name" v-model="role.display_name">
        <span>{{ errors.first('display_name') }}</span>
      </div>
      <div class="form-group">
        <textarea name="description" v-validate="'required'" class="form-control" placeholder="description" v-model="role.description"  ></textarea>
        <span>{{ errors.first('description') }}</span>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

    <h2>Roles</h2>
    
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


      
    
           <tr v-for="role in roles" v-bind:key="role.id">
      <th scope="row">{{ role.id }}</th>
      <td>{{ role.display_name }}</td>
      <td>{{ role.description }}</td>
      <td> <button @click="editRole(role)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteRole(role.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRoles(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRoles(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      roles: [],
      role: {
        id: '',
        title: '',
        body: ''
      },
      role_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchRoles();
  },
  methods: {
    fetchRoles(page_url) {
      let vm = this;
      page_url = page_url || '../api/roles';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.roles = res.data;
          vm.makePagination(res.meta, res.links);
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
    deleteRole(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/roles/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Role Removed');
            this.fetchRoles();
          })
          .catch(err => console.log(err));
      }
    },
    addRole() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/roles', {
          method: 'post',
          body: JSON.stringify(this.role),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Role Added');
            this.fetchRoles();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/role', {
          method: 'put',
          body: JSON.stringify(this.role),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Role Updated');
            this.fetchRoles();
          })
          .catch(err => console.log(err));
      }
    },
    editRole(role) {
      this.edit = true;
      this.role.id = role.id;
      this.role.role_id = role.id;
      this.role.name = role.name;
      this.role.display_name = role.display_name;
      this.role.description = role.description;
    },
    clearForm() {
      this.edit = false;
      this.role.id = null;
      this.role.role_id = null;
      this.role.name = '';
      this.role.display_name = '';
      this.role.description = '';
    },
    validation(){
      this.verrors = [];
      if(this.role.name === ''){this.verrors.push('Please Add The Name');}
      if(this.role.display_name === ''){this.verrors.push('Please Add The Display Name');}
      if(this.role.description === ''){this.verrors.push('Please Add The Description');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>