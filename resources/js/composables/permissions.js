import { usePage } from "@inertiajs/vue3";

export function usePermission() {
    const hasRole = (name) => usePage().props.auth.user.data.roles.includes(name);
    const hasPermission = (name) =>
        usePage().props.auth.user.permissions.includes(name);

    return { hasRole, hasPermission };
}
