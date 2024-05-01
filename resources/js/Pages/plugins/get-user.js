
import { computed, ref} from 'vue'
import { usePage } from '@inertiajs/vue3';
export function getUserPlugin () {
    const page = usePage()
    const user = computed(() => page.props.user)


    const getUser = () => {
        return user
    }

    return { getUser }
}


