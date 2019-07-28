<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add Exam</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
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
    <form @submit.prevent="addExam" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="exam.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="content" v-validate="'required'" class="form-control" placeholder="Content" v-model="exam.content">
        <span>{{ errors.first('content') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="mark" v-validate="'required'" class="form-control" placeholder="Mark" v-model="exam.mark">
        <span>{{ errors.first('mark') }}</span>
      </div>
      
    </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-light btn-block" data-dismiss="modal">Close</button>
        <button @click="clearForm()" class="btn btn-danger btn-block">Save</button>
      </div>
    </div>
  </div>
</div>

    <h2>Exams</h2>
    
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


      
    
           <tr v-for="exam in exams" v-bind:key="exam.id">
      <th scope="row">{{ exam.id }}</th>
      <td>{{ exam.title }}</td>
      <td>{{ exam.body }}</td>
      <td> <button @click="editExam(exam)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteExam(exam.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchExams(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchExams(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      exams: [],
      exam: {
        id: '',
        title: '',
        body: ''
      },
      exam_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchExams();
  },
  methods: {
    fetchExams(page_url) {
      let vm = this;
      page_url = page_url || '../api/exams';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.exams = res.data;
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
    deleteExam(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/exams/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Exam Removed');
            this.fetchExams();
          })
          .catch(err => console.log(err));
      }
    },
    addExam() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/exams', {
          method: 'post',
          body: JSON.stringify(this.exam),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Exam Added');
            this.fetchExams();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/exam', {
          method: 'put',
          body: JSON.stringify(this.exam),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Exam Updated');
            this.fetchExams();
          })
          .catch(err => console.log(err));
      }
    },
    editExam(exam) {
      this.edit = true;
      this.exam.id = exam.id;
      this.exam.exam_id = exam.id;
      this.exam.title = exam.title;
      this.exam.body = exam.body;
    },
    clearForm() {
      this.edit = false;
      this.exam.id = null;
      this.exam.exam_id = null;
      this.exam.title = '';
      this.exam.body = '';
    },
    validation(){
      this.verrors = [];
      if(this.exam.title === ''){this.verrors.push('Please Add The Title');}
      if(this.exam.body === ''){this.verrors.push('Please Add The Body');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>