<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New Subjects
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
    <form @submit.prevent="addSubject" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="subject.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="room" v-validate="'required'" class="form-control" placeholder="Room" v-model="subject.room">
        <span>{{ errors.first('room') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="professor" v-validate="'required'" class="form-control" placeholder="Professor" v-model="subject.professor">
        <span>{{ errors.first('professor') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="assistant" v-validate="'required'" class="form-control" placeholder="Assistant" v-model="subject.assistant">
        <span>{{ errors.first('assistant') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="description" v-validate="'required'" class="form-control" placeholder="Description" v-model="subject.description">
        <span>{{ errors.first('description') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="min_mark" v-validate="'required'" class="form-control" placeholder="Min Mark" v-model="subject.min_mark">
        <span>{{ errors.first('min_mark') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="max_mark" v-validate="'required'" class="form-control" placeholder="Max Mark" v-model="subject.max_mark">
        <span>{{ errors.first('max_mark') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="pass_mark" v-validate="'required'" class="form-control" placeholder="Pass Mark" v-model="subject.pass_mark">
        <span>{{ errors.first('pass_mark') }}</span>
      </div>
       <div class="form-group">
        <input type="text" name="type" v-validate="'required'" class="form-control" placeholder="Type" v-model="subject.type">
        <span>{{ errors.first('type') }}</span>
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

    <h2>Subjects</h2>
    
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


      
    
           <tr v-for="subject in subjects" v-bind:key="subject.id">
      <th scope="row">{{ subject.id }}</th>
      <td>{{ subject.name }}</td>
      <td>{{ subject.professor }}</td>
      <td> <button @click="editSubject(subject)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteSubject(subject.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSubjects(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSubjects(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      subjects: [],
      subject: {
        id: '',
        name: '',
        room: '',
        professor: '',
        assistant: '',
        description: '',
        min_mark: '',
        max_mark: '',
        pass_mark: '',
        type: '',
      },
      subject_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchSubjects();
  },
  methods: {
    fetchSubjects(page_url) {
      let vm = this;
      page_url = page_url || '../api/subjects';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.subjects = res.data;
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
    deleteSubject(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/subjects/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Subject Removed');
            this.fetchSubjects();
          })
          .catch(err => console.log(err));
      }
    },
    addSubject() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/subjects', {
          method: 'post',
          body: JSON.stringify(this.subject),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Subject Added');
            this.fetchSubjects();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/subject', {
          method: 'put',
          body: JSON.stringify(this.subject),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Subject Updated');
            this.fetchSubjects();
          })
          .catch(err => console.log(err));
      }
    },
    editSubject(subject) {
      this.edit = true;
      this.subject.id = subject.id;
      this.subject.subject_id = subject.id;
      this.subject.name = subject.name;
      this.subject.room = subject.room;
      this.subject.professor = subject.professor;
      this.subject.assistant = subject.assistant;
      this.subject.description = subject.description;
      this.subject.min_mark = subject.min_mark;
      this.subject.max_mark = subject.max_mark;
      this.subject.pass_mark = subject.pass_mark;
      this.subject.type = subject.type;

    },
    clearForm() {
      this.edit = false;
      this.subject.id = null;
      this.subject.subject_id = null;
      this.subject.name = null;
      this.subject.room = null;
      this.subject.professor = null;
      this.subject.assistant = null;
      this.subject.description = null;
      this.subject.min_mark = null;
      this.subject.max_mark = null;
      this.subject.pass_mark = null;
      this.subject.type = null;
    },
    validation(){
      this.verrors = [];
      if(this.subject.name === ''){this.verrors.push('Please Add The Title');}
      if(this.subject.professor === ''){this.verrors.push('Please Add The Body');}
      if(this.subject.assistant === ''){this.verrors.push('Please Add The Title');}
      if(this.subject.description === ''){this.verrors.push('Please Add The Body');}
      if(this.subject.mark === ''){this.verrors.push('Please Add The Title');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>