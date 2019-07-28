<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New TimeTable
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Timetables</h5>
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
    <form @submit.prevent="addTimetable" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="timetable.name">
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

    <h2>Timetables</h2>
    
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


      
    
           <tr v-for="timetable in timetables" v-bind:key="timetable.id">
      <th scope="row">{{ timetable.id }}</th>
      <td>{{ timetable.name }}</td>
      <td> <button @click="editTimetable(timetable)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteTimetable(timetable.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTimetables(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTimetables(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      timetables: [],
      timetable: {
        id: '',
        title: '',
        body: ''
      },
      timetable_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchTimetables();
  },
  methods: {
    fetchTimetables(page_url) {
      let vm = this;
      page_url = page_url || '../api/timetables';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.timetables = res.data;
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
    deleteTimetable(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/timetables/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Timetable Removed');
            this.fetchTimetables();
          })
          .catch(err => console.log(err));
      }
    },
    addTimetable() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/timetables', {
          method: 'post',
          body: JSON.stringify(this.timetable),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Timetable Added');
            this.fetchTimetables();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/timetable', {
          method: 'put',
          body: JSON.stringify(this.timetable),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Timetable Updated');
            this.fetchTimetables();
          })
          .catch(err => console.log(err));
      }
    },
    editTimetable(timetable) {
      this.edit = true;
      this.timetable.id = timetable.id;
      this.timetable.timetable_id = timetable.id;
      this.timetable.name = timetable.name;
    },
    clearForm() {
      this.edit = false;
      this.timetable.id = null;
      this.timetable.timetable_id = null;
      this.timetable.name = '';
    },
    validation(){
      this.verrors = [];
      if(this.timetable.name === ''){this.verrors.push('Please Add The Name');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>