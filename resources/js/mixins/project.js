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
            var filtredProjects = projects.slice();

            for (var i in filters) {
                if (filters[i] && filters[i].length > 0) {
                    filtredProjects = filtredProjects.filter(p => {
                        return filters[i].some(e => e.id === p[i].id);
                    });
                }
            }
            return filtredProjects;
        },
    },
}
