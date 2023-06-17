<?php
class ControllerExtensionModuleCategoryWall extends Controller {
    public function index() {
        $this->load->model('catalog/category');

        $data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories(0);

        foreach ($categories as $category) {
            $children_data = array();

            $children = $this->model_catalog_category->getCategories($category['category_id']);

            foreach ($children as $child) {
                $children_data[] = array(
                    'name' => $child['name'],
                    'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
                );
            }

            $data['categories'][] = array(
                'name' => $category['name'],
                'children' => $children_data,
                'thumb' => $category['image'],
                'href' => $this->url->link('product/category', 'path=' . $category['category_id'])
            );
        }

        return $this->load->view('extension/module/category_wall', $data);
    }
}
