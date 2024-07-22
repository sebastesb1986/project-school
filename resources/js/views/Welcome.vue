<template>
    <div class="container my-5">
       <div class="p-5 text-center bg-body-tertiary rounded-3">
          <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100">
             <use xlink:href="#bootstrap"/>
          </svg>
          <h1 class="text-body-emphasis">Bienvenido</h1>
          <p class="col-lg-8 mx-auto fs-5 text-muted">
             Este es el administrador de categoriás y productos de project-school y dialogflow
          </p>
          <div class="d-inline-flex gap-2 mb-5">
             <router-link :to="{ name: 'categorylist' }" class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill">Lista categorías</router-link>
             <router-link :to="{ name: 'productlist' }" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Lista productos</router-link>
          </div>
       </div>
    </div>
 </template>
