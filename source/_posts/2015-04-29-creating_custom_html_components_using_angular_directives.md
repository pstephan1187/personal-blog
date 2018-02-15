---
title: Creating Custom HTML Components Using Angular Directives
slug: Creating custom HTML components
url: creating-custom-html-components-using-angular-directives
date: 2015-04-29
image: andrian-valeanu-82531.jpg
image_link: https://unsplash.com/photos/yjXlyrKIz2A
photographer: Andrian Valeanu
---

I am working on a project using the <a href="http://vuejs.org/" target="_blank">VueJS Javascript framework</a> (If you have not checked out the framework, I highly recommend it, especially for those of you familiar with AngularJs). The project involves having a list of objects, upon which I would need to add/remove properties.

I quickly discovered that adding new properties to objects does not trigger updates to watchers, data bindings, or computed properties. This quickly became a headache for me, and after many hours of experimenting and googling, I found the fix. I will share that with you here.

## A Quick Demo

Below is a very simplified version of what I was trying to do. I had a Vue instance that contained a list of objects. Those objects were passed to a component that formatted them nicely into a list/table. Upon clicking on an item in the component, the parent list would need to be updated, which should trigger updates within the component itself. Here is a fiddle of the code: <a href="https://jsfiddle.net/pstephan1187/o0bsbdxd/" target="_blank">https://jsfiddle.net/pstephan1187/o0bsbdxd/</a>

The HTML:

```html
<div id="el">
    <people :items="people" @selectperson="handlePersonSelection"></people>
    
    <div>
        {{people | json}}
    </div>
</div>

<template id="component-template">
    <div>
        <div v-for="person in items" class="person" @click="handleClick(person)">
            {{person | json}}
        </div>
    </div>
</template>
```

The Javascript:

```javascript
var Component = Vue.extend({
	template: '#component-template',
    props: ['items'],
    methods: {
    	handleClick: function(person){
        	this.$dispatch('selectperson', person);
        }
    }
});

new Vue({
    el: '#el',
    data: {
    	people: [
        	{name: "Fred"},
        	{name: "Amelia"},
        	{name: "Gerald"},
        	{name: "Victor"},
        	{name: "Ashley"},
        	{name: "Herold"},
        	{name: "Karissa"}
        ]
    },
    methods: {
    	handlePersonSelection: function(person){
        	person.age = 20;
        }
    },
    components: {
    	people: Component
    }
});
```

The way this is supposed to work is as follows:

1. The component list items detect a click with triggers the `handleClick` method.
2. The component dispatches a `selectperson` event which is registered to the parent's `handlePersonSelection` method on the component: `<people ... @selectperson="handlePersonSelection"></people>`.
3. The `handlePersonSelection` is supposed to add the new `age` property to the represented object.
4. The change is supposed to show in the both the list and in the JSON dump.

This does not work as you can see in the fiddle. The reason is because, due to a javascript limitation, Vue cannot detect the addition of new properties on object. To overcome this, Vue provides a method to add properties to object that trigger updates: `Vue.set()`.

## The Solution

`Vue.set()` has three arguments: the object you want to add the property to, the name of the new property, and the value of the new property. So to fix the entire problem, all I had to do was change the `person.age = 20;` to `Vue.set(person, 'age', 20);` and viola!

Here is a fiddle of the working code: <a href="https://jsfiddle.net/pstephan1187/68fs48j2/1/" target="_blank">https://jsfiddle.net/pstephan1187/68fs48j2/1/</a>

And the working Javascript:

```javascript
var Component = Vue.extend({
	template: '#component-template',
    props: ['items'],
    methods: {
    	handleClick: function(person){
        	this.$dispatch('selectperson', person);
        }
    }
});

new Vue({
    el: '#el',
    data: {
    	people: [
        	{name: "Fred"},
        	{name: "Amelia"},
        	{name: "Gerald"},
        	{name: "Victor"},
        	{name: "Ashley"},
        	{name: "Herold"},
        	{name: "Karissa"}
        ]
    },
    methods: {
    	handlePersonSelection: function(person){
        	Vue.set(person, 'age', 20);
        }
    },
    components: {
    	people: Component
    }
});
```

You can read more about VueJS and reactivity here: <a href="https://vuejs.org/guide/reactivity.html" target="_blank">https://vuejs.org/guide/reactivity.html</a>. I hope this saves you a lot of time.