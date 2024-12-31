"use strict";(self.webpackChunkwebsite=self.webpackChunkwebsite||[]).push([[976],{2053:(e,n,s)=>{s.r(n),s.d(n,{assets:()=>o,contentTitle:()=>l,default:()=>h,frontMatter:()=>a,metadata:()=>t,toc:()=>c});const t=JSON.parse('{"id":"intro","title":"Installation","description":"1. Install the package:","source":"@site/docs/intro.md","sourceDirName":".","slug":"/intro","permalink":"/springcms/docs/intro","draft":false,"unlisted":false,"editUrl":"https://github.com/facebook/docusaurus/tree/main/packages/create-docusaurus/templates/shared/docs/intro.md","tags":[],"version":"current","sidebarPosition":1,"frontMatter":{"sidebar_position":1},"sidebar":"tutorialSidebar","next":{"title":"Sliders","permalink":"/springcms/docs/Guides/sliders"}}');var i=s(4848),r=s(8453);const a={sidebar_position:1},l="Installation",o={},c=[];function d(e){const n={a:"a",code:"code",h1:"h1",header:"header",li:"li",ol:"ol",p:"p",pre:"pre",...(0,r.R)(),...e.components};return(0,i.jsxs)(i.Fragment,{children:[(0,i.jsx)(n.header,{children:(0,i.jsx)(n.h1,{id:"installation",children:"Installation"})}),"\n",(0,i.jsxs)(n.ol,{children:["\n",(0,i.jsx)(n.li,{children:"Install the package:"}),"\n"]}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-bash",children:"composer require bitpixel/springcms:dev-master\n"})}),"\n",(0,i.jsxs)(n.ol,{children:["\n",(0,i.jsxs)(n.li,{children:["\n",(0,i.jsxs)(n.p,{children:["Remove the default home route from ",(0,i.jsx)(n.code,{children:"routes/web.php"}),". We will use the route that is defined in our package."]}),"\n"]}),"\n",(0,i.jsxs)(n.li,{children:["\n",(0,i.jsxs)(n.p,{children:["This package uses the (",(0,i.jsx)(n.a,{href:"https://github.com/UniSharp/laravel-filemanager)%5Bhttps://github.com/UniSharp/laravel-filemanager",children:"https://github.com/UniSharp/laravel-filemanager)[https://github.com/UniSharp/laravel-filemanager"}),"] package to manage images. Run the following command to publish laravel-filemanager config && assets:"]}),"\n"]}),"\n"]}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-bash",children:"php artisan vendor:publish --tag=lfm_config --force\n"})}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-bash",children:"php artisan vendor:publish --tag=lfm_public --force\n"})}),"\n",(0,i.jsxs)(n.p,{children:["This will generate ",(0,i.jsx)(n.code,{children:"config/lfm.php"}),". Edit this file and set ",(0,i.jsx)(n.code,{children:"use_package_routes"})," to ",(0,i.jsx)(n.code,{children:"false"}),"."]}),"\n",(0,i.jsxs)(n.p,{children:["Update filesystem config: Open ",(0,i.jsx)(n.code,{children:"config/filesystem.php"})," & change the public disk as follows:"]}),"\n",(0,i.jsx)(n.pre,{children:(0,i.jsx)(n.code,{className:"language-php",children:"'public' => [\r\n            'driver' => 'local',\r\n            'root' => public_path('/uploads/files'),\r\n            'url' => '/uploads/files',\r\n            'visibility' => 'public',\r\n            'throw' => false,\r\n        ],\n"})}),"\n",(0,i.jsxs)(n.ol,{start:"4",children:["\n",(0,i.jsxs)(n.li,{children:["Run the project using ",(0,i.jsx)(n.code,{children:"php artisan serve"})," && open the project in your browser. It should redirect to the ",(0,i.jsx)(n.code,{children:"/install"})," route. Complete the installation process by following the steps."]}),"\n"]})]})}function h(e={}){const{wrapper:n}={...(0,r.R)(),...e.components};return n?(0,i.jsx)(n,{...e,children:(0,i.jsx)(d,{...e})}):d(e)}},8453:(e,n,s)=>{s.d(n,{R:()=>a,x:()=>l});var t=s(6540);const i={},r=t.createContext(i);function a(e){const n=t.useContext(r);return t.useMemo((function(){return"function"==typeof e?e(n):{...n,...e}}),[n,e])}function l(e){let n;return n=e.disableParentContext?"function"==typeof e.components?e.components(i):e.components||i:a(e.components),t.createElement(r.Provider,{value:n},e.children)}}}]);