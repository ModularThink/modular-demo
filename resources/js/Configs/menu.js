import { ZiggyVue } from '/vendor/tightenco/ziggy/dist/vue.m'

export default {
    // main navigation - side menu
    items: [
        {
            label: 'Dashboard',
            permission: 'Main Menu: Dashboard',
            icon: 'ri-dashboard-line',
            link: route('dashboard.index')
        },

        {
            label: 'Blog',
            permission: 'Main Menu: Blog',
            children: [
                {
                    label: 'Posts',
                    permission: 'Main Menu: Blog: Posts - List',
                    icon: 'ri-user-line',
                    link: route('blogPost.index')
                }
                // {
                //     label: 'Permissions',
                //     permission:
                //         'Main Menu: Access Control List: Permissions - List',
                //     icon: 'ri-shield-keyhole-line',
                //     link: route('aclPermission.index')
                // },
                // {
                //     label: 'Roles',
                //     permission: 'Main Menu: Access Control List: Roles - List',
                //     icon: 'ri-account-box-line',
                //     link: route('aclRole.index')
                // }
            ]
        },

        {
            label: 'Access Control List',
            permission: 'Main Menu: Access Control List',
            children: [
                {
                    label: 'Users',
                    permission: 'Main Menu: Access Control List: Users - List',
                    icon: 'ri-user-line',
                    link: route('user.index')
                },
                {
                    label: 'Permissions',
                    permission:
                        'Main Menu: Access Control List: Permissions - List',
                    icon: 'ri-shield-keyhole-line',
                    link: route('aclPermission.index')
                },
                {
                    label: 'Roles',
                    permission: 'Main Menu: Access Control List: Roles - List',
                    icon: 'ri-account-box-line',
                    link: route('aclRole.index')
                }
            ]
        }
    ]
}
