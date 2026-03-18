# game-love-app

## Project launch:
1. composer run setup
2. composer run dev

## TODO:

- Add auth, preferably with Sanctum, and hide post endpoints behind it
- Remove passing player_id with love/unlove request since passing it becomes redundant with auth check by token
- Change the love/unlove actions to use route model binding, use DELETE method to unlove a game
- Add caching/research other possibilities to improve getting top loved games performance
- Expand test coverage

## Endpoints:

- GET /api/games?page={page} - return list of all games with pagination
- POST /api/games/love - love a game
- PUT /api/games/unlove - unlove a game
- GET /api/players/{player}/loved-games - return list of games loved by player of id {player}
- GET /api/games/most-loved?limit={limit} - return list of {limit} games most loved by players
