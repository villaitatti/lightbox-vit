<?php

/**
* Exhibit lightbox gallery view helper.
*
* @package LightboxGallery\View\Helper
*/
class LightboxGallery_View_Helper_ExhibitAttachmentLightboxGallery extends Zend_View_Helper_Abstract
{

	/**
	 * Return the markup for a gallery of exhibit attachments.
	 *
	 * @uses ExhibitBuilder_View_Helper_ExhibitAttachment
	 * @param ExhibitBlockAttachment[] $attachments
	 * @param array $fileOptions
	 * @param array $linkProps
	 * @return string
	 */
	public function exhibitAttachmentLightboxGallery($attachments, $fileOptions = array(), $linkProps = array())
	{
		if (!isset($fileOptions['imageSize'])) {
			$fileOptions['imageSize'] = 'square_thumbnail';
		}

		$html = '';
        $numItem = 1;
		foreach ($attachments as $attachment) {
			$html .= '<div class="exhibit-item exhibit-gallery-item">';
			$html .= $this->view->exhibitAttachmentLightbox($attachment, $fileOptions, $linkProps);
            $item = $attachment->getItem();
            //print_r($item);
            $html .= '<div class="lb-metadata-container" id="image-metadata-container-'. $numItem .'" style="display:none;">';
            $html .= '<h2 style="font-weight:bold;">';
            $title = metadata($item, array('Dublin Core', 'Title'));
            $html .= $title;
            $html .= '</h2>';
            if (metadata($item, 'has tags')):
            $html .= '<div id="item-tags" class="element">';
            $html .= '<div class="element-text">' . tag_string($item) . '</div>';
            $html .= '</div>';
            endif;
          
            //$html .= '<ul style="margin-bottom:30px; margin-top:30px;" class="accordion" data-accordion="myAccordionGroup">';
            //$html .= '<li class="accordion-navigation">';
            //$html .= '<a href="#panel1a"><b style="color: #de171c">ITEM DATA</b></a>';
            //$html .= '<div id="panel1a" class="content">';
            $html .= '<div>';
            $box_number = metadata($item, array('Item Type Metadata', 'Box Number'));
            if ($box_number):;
            $html .= '<h6 class="accordion-item-titles">Box Number</h6>';
            $html .= '<p>' . $box_number . '</p>';
            endif;
            $folder_number = metadata($item, array('Item Type Metadata', 'Folder Number'));
            if ($folder_number):;
            $html .= '<h6 class="accordion-item-titles">Folder Number</h6>';
            $html .= '<p>' . $folder_number . '</p>';
            endif;
            $image_number = metadata($item, array('Item Type Metadata', 'Image Number'));
            if ($image_number):;
            $html .= '<h6 class="accordion-item-titles">Image Number</h6>';
            $html .= '<p>' . $image_number . '</p>';
            endif;
            $folder_title = metadata($item, array('Item Type Metadata', 'Folder Title'));
            if ($folder_title):;
            $html .= '<h6 class="accordion-item-titles">Folder Title</h6>';
            $html .= '<p>' . $folder_title . '</p>';
            endif;
            $photographer = metadata($item, array('Item Type Metadata', 'Photographer'));
            if ($photographer):;
            $html .= '<h6 class="accordion-item-titles">Photographer</h6>';
            $html .= '<p>' . $photographer . '</p>';
            endif;
            $location = metadata($item, array('Item Type Metadata', 'Location'));
            if ($location):;
            $html .= '<h6 class="accordion-item-titles">Location</h6>';
            $html .= '<p>' . $location . '</p>';
            endif;
            $artist = metadata($item, array('Item Type Metadata', 'Artist'));
            if ($artist):;
            $html .= '<h6 class="accordion-item-titles">Artist</h6>';
            $html .= '<p>' . $artist . '</p>';
            endif;
            $restorer = metadata($item, array('Item Type Metadata', 'Restorer'));
            if ($restorer):
            $html .= '<h6 class="accordion-item-titles">Restorer</h6>';
            $html .= '<p>' . $restorer . '</p>';
            endif;
            $physical_dimensions = metadata($item, array('Item Type Metadata', 'Physical Dimensions'));
            if ($physical_dimensions):
            $html .= '<h6 class="accordion-item-titles">Physical Dimension</h6>';
            $html .= '<p>' . $physical_dimensions . '</p>';
            endif;
            
            
            
            
            
            $html .= '</div>';
            //$html .= '</div>';
            //$html .= '</li>';
            //$html .= '</ul>';
              // image-metadata-container closing div
            $html .= '</div>';
            $html .= '</div>';
            $numItem++;
		}
        
		
		return apply_filters('exhibit_attachment_gallery_markup', $html,
			compact('attachments', 'fileOptions', 'linkProps'));
	}
}
