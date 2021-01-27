import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import status from './components/HeroComponent.vue'//自分のステータス
import tasks from './components/TaskComponent.vue'//タスク一覧
import items from './components/ItemsComponent.vue'//アイテム一覧

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

const routes = [
    { path: '',component:tasks},
    { path: '/status',component: status },
//    { path: '/taskform',component: taskform },
    { path: '/items',component: items},
    { 
      path: '/tasks', 
      component: tasks,
      props: true
   },

  ]
  
  // VueRouterインスタンスを作成する
  const router = new VueRouter({
    routes
  })
  // VueRouterインスタンスをエクスポートする
  // app.jsでインポートするため
  export default router