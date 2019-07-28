<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New Eduyear
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Year</h5>
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
    <form @submit.prevent="addEduyear" class="mb-3">
      <div class="form-group">
        <input type="text" name="start" v-validate="'required'" class="form-control" placeholder="Start" v-model="eduyear.start">
        <span>{{ errors.first('start') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="end" v-validate="'required'" class="form-control" placeholder="End" v-model="eduyear.end">
        <span>{{ errors.first('end') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="year" v-validate="'required'" class="form-control" placeholder="Year" v-model="eduyear.year">
        <span>{{ errors.first('year') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="semester" v-validate="'required'" class="form-control" placeholder="Semester" v-model="eduyear.semester">
        <span>{{ errors.first('Semester') }}</span>
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

    <h2>Edu Years</h2>
    
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>


      
    
      <tr v-for="eduyear in eduyears" v-bind:key="eduyear.id">
      <th scope="row">{{ eduyear.id }}</th>
      <td>{{ eduyear.start }}</td>
      <td>{{ eduyear.end }}</td>
      <td> <button @click="editEduyear(eduyear)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteEduyear(eduyear.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchEduyears(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchEduyears(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      eduyears: [],
      eduyear: {
        id: '',
        start: '',
        end: ''
      },
      eduyear_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchEduyears();
  },
  methods: {
    fetchEduyears(page_url) {
      let vm = this;
      page_url = page_url || '../api/eduyears';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.eduyears = res.data;
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
    deleteEduyear(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../api/eduyears/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Eduyear Removed');
            this.fetchEduyears();
          })
          .catch(err => console.log(err));
      }
    },
    addEduyear() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/eduyears', {
          method: 'post',
          body: JSON.stringify(this.eduyear),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Eduyear Added');
            this.fetchEduyears();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/eduyear', {
          method: 'put',
          body: JSON.stringify(this.eduyear),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Eduyear Updated');
            this.fetchEduyears();
          })
          .catch(err => console.log(err));
      }
    },
    editEduyear(eduyear) {
      this.edit = true;
      this.eduyear.id = eduyear.id;
      this.eduyear.eduyear_id = eduyear.id;
      this.eduyear.start = eduyear.start;
      this.eduyear.end = eduyear.end;
      this.eduyear.year = eduyear.year;
      this.eduyear.semester = eduyear.semester;
    },
    clearForm() {
      this.edit = false;
      this.eduyear.id = null;
      this.eduyear.eduyear_id = null;
      this.eduyear.start = '';
      this.eduyear.end = '';
      this.eduyear.year = '';
      this.eduyear.semester = '';
    },
    validation(){
      this.verrors = [];
      if(this.eduyear.start === ''){this.verrors.push('Please Add The Start');}
      if(this.eduyear.end === ''){this.verrors.push('Please Add The End');}
       if(this.eduyear.year === ''){this.verrors.push('Please Add The Year');}
      if(this.eduyear.semester === ''){this.verrors.push('Please Add The Semester');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>