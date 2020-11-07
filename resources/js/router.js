import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import status from './components/HeroComponent.vue'
import tasks from './components/TaskComponent.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

//テスト用
//const Foo = { template: '<div>foo</div>' }
//const Bar = { template: '<div>bar</div>' }


const routes = [
    { path: '/status',component: status },
    { 
      path: '/tasks', 
      component: tasks,
      props: true
   }
  ]
  
  // VueRouterインスタンスを作成する
  const router = new VueRouter({
    routes
  })
  
  // VueRouterインスタンスをエクスポートする
  // app.jsでインポートするため
  export default router