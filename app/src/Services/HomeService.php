<?php
namespace App\Services;

use App\Models\Articles;

class HomeService
{
    const PER_PAGE = 3;
    const DEFAULT_IMG = 'default.jpg';
    /**
     * Count Articles.
     * @return int
     */
    public function countArticles()
    {
        return Articles::count();
    }
    /**
     * Select Database.
     * @param int $page
     * @return array
     */
    public function selectDatabase($page)
    {
        $results = Articles::select("*")
            ->orderBy('created','DESC')
            ->skip($page)
            ->take(SELF::PER_PAGE)
            ->get();

        if (empty($results)) {
            return [];
        }
        $res = [];
        foreach ($results as $result) {
            $res[$result->id]['id'] = $result->id;
            $res[$result->id]['title'] = $result->title;
            $res[$result->id]['image'] = !empty($result->image) ? $result->image : SELF::DEFAULT_IMG;
            $res[$result->id]['date'] = date('d/m/Y H:i', strtotime($result->created));
            $res[$result->id]['summary'] = $result->summary;
        }

        return $res;
    }
}
