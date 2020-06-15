import STATE from "./loadingState";

export const ProjectMixins = {
    methods: {
        getProjects(degree) {
            if (this.$store.getters.getProjectsLoadStatus != 2) return null;

            return this.$store.getters.getProjects.data.filter(p => {
                return p.degree === degree;
            });
        },

        filterProjects(projects, filters) {
            if (!projects || !filters) return null;
            return projects.filter(p => {
                for (var category in filters) {
                    if(filters[category] && p[category]) {
                        if (filters[category].id !== p[category].id) return false;
                    }
                }
                return true;
            });
        },
    },
}
