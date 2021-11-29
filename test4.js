const response = [
    {
        "page": 1,
        "totalPages": 5,
        "data": [
            {
                "title": "Movie 1",
                "rating": 4.7
            },
            {
                "title": "Movie 2",
                "rating": 7.8
            }
        ]
    },
    {
        "page": 2,
        "totalPages": 5,
        "data": [
            {
                "title": "Movie 3",
                "rating": 5.1
            },
            {
                "title": "Movie 4",
                "rating": 2.4
            }
        ]
    },
    {
        "page": 2,
        "totalPages": 5,
        "data": [
            {
                "title": "Movie 3",
                "rating": 5.1
            },
            {
                "title": "Movie 4",
                "rating": 2.4
            }
        ]
    } 
]


class MovieMetrics {
    constructor() {
        this.movies = movies
    }

    getMaximum() {
        return Math.max.apply(Math, this.movies.map(movie => movie.rating))
    }

    getAverage() {
        return (this.movies.reduce((acc, movie) => acc + movie.rating, 0) / this.movies.length)        
    }
}

const movies = response.map(page => page.data).flat()
const movieMetrics = new MovieMetrics(movies)

console.log('movies: ', movies)
console.log('maximum: ', movieMetrics.getMaximum())
console.log('average: ', movieMetrics.getAverage())

