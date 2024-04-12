
import { computed, ref} from 'vue'
import { usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
export function permissionChecker () {
    const page = usePage()
    const permissions = computed(() => page.props.permissions)

    const canAdd = () => {

        return permissions.value.some(permission => permission.name === 'Can Add');
        
    }

    const canEdit = () => {
        return permissions.value.some(permission => permission.name === 'Can Update');
    }

    const canDelete = () => {
        return permissions.value.some(permission => permission.name === 'Can Delete');
    }

    const popUp = () => {
        Swal.fire({
            'title': 'Warning',
            'text': 'You are not allowed to perform this action',
            'icon': 'warning'
        })
    }


    return { canAdd, canEdit, canDelete, popUp }
}


