<?php
namespace App\Services;

use App\Models\Articles;

class ArticleCreateService
{
    /**
     * Validate method.
     * @param array $params
     * @return boolean|string
     */
    public function validate($params)
    {
        $err = '';
        if (empty($params['title'])) {
            $err .= 'Title is required';
        }
        if (empty($params['summary'])) {
            $err .= 'Summary is required';
        }

        if (!empty($err)) {
            return $err;
        }
        return TRUE;
    }

    /**
     * Insert in Database.
     * @param array $input
     * @return boolean
     */
    public function insertDatabase($input)
    {
        try {
            Articles::create([
                'title' => $input['title'],
                'summary' => $input['summary'],
                'content' => $input['content'],
                'image' => $input['image'],
                'authorId' => $_SESSION['id'],
            ]);
            return TRUE;
        } catch ( \Exception $e ) {
            return FALSE;
        }
    }
}
