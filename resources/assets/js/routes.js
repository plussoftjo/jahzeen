import main from './components/main/index.vue';
import service from './components/service/index.vue';
import subService from './components/subService/index.vue'
import price from './components/price/index.vue'
import orders from './components/orders/index.vue'
import order from './components/order/index'
import approveOrders from './components/approveOrders/index.vue'
import approveOrder from './components/approveOrder/index'
import driver from './components/driver/index.vue'
import complateOrders from './components/complateOrders/index.vue'

export const routes = 
[
	{
		path:'/',
		name:'main',
		component:main
	},
	{
		path:'/service',
		name:'service',
		component:service
	},
	{
		path:'/subService',
		name:'subService',
		component:subService
	},
	{
		path:'/price',
		name:'price',
		component:price
	},
	{
		path:'/orders',
		name:'orders',
		component:orders
	},
	{
		path:'/order/:id',
		name:'order',
		component:order
	},
	{
		path:'/approveOrders',
		name:'approveOrders',
		component:approveOrders
	},
	{
		path:'/approveOrder/:id',
		name:'approveOrder',
		component:approveOrder
	},
	{
		path:'/driver',
		name:'driver'
		,component:driver
	},
	{
		path:'/complateOrders',
		name:'complateOrders',
		component:complateOrders
	}

]