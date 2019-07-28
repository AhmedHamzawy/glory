<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New Duration
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Durations</h5>
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
    <form @submit.prevent="addDuration" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="duration.name">
        <span>{{ errors.first('name') }}</span>
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

    <h2>Durations</h2>
    
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


      
    
           <tr v-for="duration in durations" v-bind:key="duration.id">
      <th scope="row">{{ duration.id }}</th>
      <td>{{ duration.name }}</td>
      <td> <button @click="editDuration(duration)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteDuration(duration.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchDurations(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchDurations(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      durations: [],
      duration: {
        id: '',
        title: '',
        body: ''
      },
      duration_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchDurations();
  },
  methods: {
    fetchDurations(page_url) {
      let vm = this;
      page_url = page_url || '../api/durations';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.durations = res.data;
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
    deleteDuration(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/durations/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Duration Removed');
            this.fetchDurations();
          })
          .catch(err => console.log(err));
      }
    },
    addDuration() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/durations', {
          method: 'post',
          body: JSON.stringify(this.duration),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Duration Added');
            this.fetchDurations();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/duration', {
          method: 'put',
          body: JSON.stringify(this.duration),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Duration Updated');
            this.fetchDurations();
          })
          .catch(err => console.log(err));
      }
    },
    editDuration(duration) {
      this.edit = true;
      this.duration.id = duration.id;
      this.duration.duration_id = duration.id;
      this.duration.name = duration.name;
    },
    clearForm() {
      this.edit = false;
      this.duration.id = null;
      this.duration.duration_id = null;
      this.duration.name = '';
    },
    validation(){
      this.verrors = [];
      if(this.duration.name === ''){this.verrors.push('Please Add The Name');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>