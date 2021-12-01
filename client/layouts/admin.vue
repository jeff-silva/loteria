<template>
	<div>

		<div class="d-flex">
			<div style="max-width:300px;">
				<ui-sidebar ref="sidebar" storeid="admin-nav" style="min-width:250px; max-width:250px;">
					<div class="bg-dark">
						<nuxt-link to="/admin" class="d-block p-3 text-white" style="text-decoration:none;">
							{{ APP_NAME }}
						</nuxt-link>

						<div class="text-center py-3" style="border-top: solid 1px #ffffff22; border-bottom: solid 1px #ffffff22;">
							<img :src="$store.state.auth.user.photo" alt="" style="width:80px; height:80px; object-fit:cover; border-radius:50%; border:solid 3px #eee;">
							<div class="text-white fw-bold mt-3">Olá {{ $store.state.auth.user.name }}</div>
						</div>

						<div class="scrollbar-thin-dark" style="height:calc(100vh - 210px); overflow:auto;">
							<ui-nav :items="$store.state.admin.menu" mode="vertical" text-color="#fff"></ui-nav>
						</div>
					</div>
				</ui-sidebar>
			</div>

			<div class="flex-grow-1" style="overflow:auto;">
				<div class="d-flex align-items-center bg-dark p-3 text-white">
					<div>
						<a href="javascript:;" class="text-white" @click="$refs.sidebar.toggleDesktop(); $refs.sidebar.toggleMobile();">
							<i class="align-self-center fas fa-bars"></i>
						</a>
					</div>

					<div class="flex-grow-1">&nbsp;</div>

					<div>
						<ui-dropdown v-bind="{right:true}">
							<a href="javascript:;" class="text-white" style="text-decoration:none;">
								<!-- <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" :alt="$auth.user.name" /> -->
								{{ $auth.user.name }}
							</a>
	
							<template #dropdown>
								<div class="bg-white shadow mt-3" style="width:220px;">
									<div class="text-center py-3">
										<img :src="$store.state.auth.user.photo" alt="" style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
									</div>
									<div class="list-group list-group-flush">
										<nuxt-link :to="o.to" class="list-group-item" :key="i" v-for="(o, i) in $store.state.admin.userOptions">
											<i :class="o.icon" class="me-2"></i> {{ o.label }}
										</nuxt-link>
										<a href="javascript:;" class="list-group-item" @click="$auth.logout()">
											<i class="fas fa-power-off"></i> Log out
										</a>
									</div>
								</div>
								<!-- <div class="dropdown-menu dropdown-menu-end show">
									<nuxt-link :to="o.to" class="dropdown-item" :key="i" v-for="(o, i) in $store.state.admin.userOptions">
										<i :class="o.icon" class="me-2"></i> {{ o.label }}
									</nuxt-link>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:;" @click="$auth.logout()">Log out</a>
								</div> -->
							</template>
						</ui-dropdown>
					</div>
				</div>

				<div class="p-2 scrollbar-thin" style="height:calc(100vh - 56px); overflow:auto;">
					<nuxt></nuxt>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			APP_NAME: process.env.APP_NAME,
		};
	},

	methods: {
		toggleClass(selector, className) {
			if (typeof selector=='string') {
				selector = document.querySelector(selector);
			}

			selector.classList.toggle(className);
		},
	},

	mounted() {
		this.$helpers.timeout({name:'layouts-admin-sync', interval:60000, callback: () => {
			this.$store.dispatch('app/init');
		}});
	},
}
</script>

<style scoped lang="scss">
/* @import './adminkit.scss'; */
</style>