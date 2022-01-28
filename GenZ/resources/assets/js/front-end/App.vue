<template>
	<div>
		<HeaderCom></HeaderCom>		
		<router-view></router-view>
		<Footercom></Footercom>
	</div>
</template>

<script>
import HeaderCom 		from './components/Layouts/HeaderCom'
import Footercom 		from './components/Layouts/FooterCom'
export default {
	name: 'main_route',
	components: {
	    HeaderCom,
	    Footercom
	}
}
</script>

