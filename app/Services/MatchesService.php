<?php

namespace App\Services;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MatchesService
{
    public function gets($page = 1, $sport_id = null, $date = null){
        $recordPerPage = 5;
        $take = $page * $recordPerPage;

        $query = $this->newQuery();

        if(!empty($sport_id))
            $query->where('matches.sport_id', $sport_id);

        if(!empty($date)){
            $dates = explode('/', $date);
            $date_format = "{$dates[2]}-{$dates[1]}-{$dates[0]}";
            $query->whereDate('matches.date', $date_format);
        }else{
            $query->whereDate('matches.date', '>=', date('Y-m-d'));
        }

        //Count for pagination
        $totalCount = clone $query;
        $totalCount = $totalCount->count();

        //get dates
        $available_dates = clone $query;
        $available_dates = $available_dates->select('matches.date')->distinct()->take(10)->get()->pluck('date')->toArray();

        $matches = $query
            ->take($take)
            ->get();
        $dates = $matches->pluck('date')->unique();
        return array(
            'pages' => round(($totalCount / $recordPerPage)),
            'rows' => $matches,
            'dates' => $dates,
            'available_dates' => $available_dates
        );
    }

    public function getUpcomingMatch(): Collection
    {
        return $this->newQuery()
            ->whereDate('matches.date', '>=', date('Y-m-d'))
            ->take(3)
            ->get();
    }

    public function getHighLightMatch()
    {
        return $this->newQuery()->where('matches.highlight', 1)->first();
    }

    public function getBySlug($slug)
    {
        return $this->newQuery()->where('matches.slug', $slug)->first();
    }

    private function newQuery(): Builder
    {
        return DB::table('matches')
            ->join('sports', 'matches.sport_id', '=', 'sports.id')
            ->join('leagues', 'matches.league_id', '=', 'leagues.id')
            ->join('clubs as first_clubs', 'matches.club_id_one', '=', 'first_clubs.id')
            ->join('clubs as second_clubs', 'matches.club_id_two', '=', 'second_clubs.id')
            ->orderBy('matches.date')
            ->select('matches.*', 'sports.name as sport_name', 'leagues.name as league_name', 'first_clubs.name as first_club_name',
                'first_clubs.logo as first_club_logo', 'second_clubs.name as second_club_name', 'second_clubs.logo as second_club_logo');
    }



}
