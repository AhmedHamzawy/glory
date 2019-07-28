<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add New Book
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Books</h5>
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
    <form @submit.prevent="addBook" class="mb-3">
      <div class="form-group">
        <input type="text" name="title" v-validate="'required'" class="form-control" placeholder="Title" v-model="book.title">
        <span>{{ errors.first('title') }}</span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Body" v-model="book.body"></textarea>
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

    <h2>Books</h2>
    
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


      
    
           <tr v-for="book in books" v-bind:key="book.id">
      <th scope="row">{{ book.id }}</th>
      <td>{{ book.title }}</td>
      <td>{{ book.body }}</td>
      <td> <button @click="editBook(book)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBooks(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBooks(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      books: [],
      book: {
        id: '',
        title: '',
        body: ''
      },
      book_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchBooks();
  },
  methods: {
    fetchBooks(page_url) {
      let vm = this;
      page_url = page_url || '../api/books';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.books = res.data;
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
    deleteBook(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/books/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Book Removed');
            this.fetchBooks();
          })
          .catch(err => console.log(err));
      }
    },
    addBook() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/books', {
          method: 'post',
          body: JSON.stringify(this.book),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Book Added');
            this.fetchBooks();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/book', {
          method: 'put',
          body: JSON.stringify(this.book),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Book Updated');
            this.fetchBooks();
          })
          .catch(err => console.log(err));
      }
    },
    editBook(book) {
      this.edit = true;
      this.book.id = book.id;
      this.book.book_id = book.id;
      this.book.title = book.title;
      this.book.body = book.body;
    },
    clearForm() {
      this.edit = false;
      this.book.id = null;
      this.book.book_id = null;
      this.book.title = '';
      this.book.body = '';
    },
    validation(){
      this.verrors = [];
      if(this.book.title === ''){this.verrors.push('Please Add The Title');}
      if(this.book.body === ''){this.verrors.push('Please Add The Body');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>