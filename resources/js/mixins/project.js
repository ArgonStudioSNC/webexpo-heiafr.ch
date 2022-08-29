import STATE from "./loadingState";
import { computed } from 'vue'
import { useStore } from 'vuex'

export const ProjectMixins = {
    setup () {
        const store = useStore()

        const projectsLoadStatus = computed(() => store.getters.getProjectsLoadStatus)

        const projects = computed(() => store.getters.getProjects)

        function getProjects(degree) {
            if (projectsLoadStatus != 2) return null;

            return projects.data.filter(p => {
                return p.degree === degree;
            });
        }

        function filterProjects(projects, filters) {
            if (!projects || !filters) return null;

            var filtredProjects = projects.slice();

            for (var i in filters) {
                if (filters[i] && filters[i].length > 0) {
                    filtredProjects = filtredProjects.filter(p => {
                        return filters[i].some(e => e.id === p[i].id);
                    });
                }
            }
            return filtredProjects;
        }

        return {
            projectsLoadStatus,
            projects,
            getProjects,
            filterProjects
        }
    },
}
