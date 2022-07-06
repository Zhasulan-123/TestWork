<template>
  <div class="container">
    <div class="row">
        <div class="col">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand">
                        Администратор
                    </a>
                    <a href="#" @click="logout" class="d-flex">Выход</a>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col mt-5">
          <form @submit.prevent="addPage">
            <div class="row">
                <div class="col">
                    <input 
                        v-model="form.title"
                        type="text" 
                        class="form-control" 
                        placeholder="Название"
                    >
                </div>
                <div class="col">
                    <input 
                        v-model="form.description"
                        type="text" 
                        class="form-control" 
                        placeholder="Описание"
                    >
                </div>
                <div class="col">
                    <input 
                        v-model="form.text"
                        type="text" 
                        class="form-control" 
                        placeholder="Текст"
                    >
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
          </form>
        </div>
     </div>
     <div class="row">
        <div class="col mt-5">
           <table class="table">
            <thead>
                <tr>
                <th scope="col">№</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Текст</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr
                  v-for="(item, index) in pages"
                  :key="index"
                >
                    <td>{{item.id}}</td>
                    <td>{{item.title}}</td>
                    <td>{{item.description}}</td>
                    <td>{{item.text}}</td>
                    <td>
                        <a href="#" @click="deletePage(item)">
                            <span class="material-symbols-outlined cl_text">dangerous</span>
                        </a>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
     </div>
   </div>
</template>

<script>
import authService from "@/api/auth.service";
import pageService from "@/api/page.service";

export default {
   name: 'Page',
   data() {
	  return {
	    pages: [],
        form: {
            title: '',
            description: '',
            text: '',
        },
	  }
	},
	methods: {
      logout() {
         authService.logout();
      },
	  async addPage() {
	    const {status, data} = await pageService.create(this.form);
	    if (status === 201) {
	      this.pages.unshift(data);
	    }
        this.form.title = '';
        this.form.description = '';
        this.form.text = '';
	  },
	  async deletePage(page) {
        if(confirm('Вы уверены, что хотите удалить этот элемент ?')){
            const {status} = await pageService.delete(page.id);
            if (status === 204) {
               this.pages.splice(this.pages.indexOf(page), 1);
            }
        }
	  }
	},
	async beforeMount() {
	  const {status, data} = await pageService.get();
	  if (status === 200) {
	    this.pages = data;
	  }
	}
}
</script>

<style scope>
.cl_text{
    color: red;
}
</style>